<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaderRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;
use Illuminate\Support\Facades\Session;
use App\Models\PortalSet; 
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    public function register(){
        return view("leader.register");
    }
    public function registerStore(Request $request)
    {
        Log::info('Leader self-registration started.', ['email' => $request->email]);
        DB::beginTransaction(); 

        try {
            if ($request->hasFile('idproof')) {
                // ... (File Uploading Logic) ...
            }

            // --- 1. User Creation ---
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email; 
            $user->password = Hash::make($request->password);
            $user->address = $request->address;
            $user->id_proof = $request->idproof ?? null;
            $user->role = 2;
            $user->save();
            Log::info('New Leader user created successfully.', ['user_id' => $user->id]);
            
            // --- 2. PortalSet Check ---
            $portalSet = PortalSet::where('is_active', 1)->first();
            
            if (!$portalSet) {
                Log::error('CRITICAL: No active PortalSet found for leader registration.', ['user_email' => $request->email]);
                throw new \Exception("No active PortalSet found for group creation.");
            }
            Log::debug('Active PortalSet found.', ['portal_set_id' => $portalSet->id]);

            // --- 3. Group Number Decrement ---
            Group::where('portal_set_id', $portalSet->id)
                ->whereBetween('group_number', [6, 52])
                ->decrement('group_number');
            Log::info('Group numbers decremented for PortalSet.', ['portal_set_id' => $portalSet->id]);

            $names = [
                'Mercury', 'Venus', 'Jupiter', 'Saturn', 'Uranus', 'Neptune',
                'Pluto', 'Sky', 'Moon', 'Sun', 'Heaven'
            ];

            $totalGroups = Group::where('portal_set_id', $portalSet->id)
                ->where('group_number', '>=', 6)
                ->count();
                
            $nameIndex = $totalGroups % count($names);
            $cycle = intdiv($totalGroups, count($names));

            $baseName = $names[$nameIndex];
            $groupName = $cycle > 0 ? $baseName . $cycle : $baseName;
            Log::debug('Generated Group Name.', ['name' => $groupName, 'total_groups' => $totalGroups]);

            $inviteLink = Str::uuid()->toString();

            // --- 4. Group Creation ---
            $group = Group::create([
                'portal_set_id' => $portalSet->id,
                'target_amount' => $portalSet->target_amount,
                'name' => $groupName,
                'group_number' => 52,
                'leader_id' => $user->id,
                'current_amount' => 0,
                'project_name' => $request->project_name ?? $groupName,
                'project_description' => $request->project_description ?? "Auto-generated group for new leader registration",
                'logo_path' => null,
                'video_path' => null,
                'invite_link' => $inviteLink,
                'is_active' => true
            ]);
            Log::info('New Group created successfully.', ['group_id' => $group->id, 'group_name' => $groupName]);
            
            DB::commit();
            Log::info('Transaction committed. Leader registration completed successfully.', ['user_id' => $user->id]);

            return redirect()->route('leader.login')->with('success','Registration successful. Please login.');
            
        } catch (\Throwable $th) {
            DB::rollBack();
            
            // --- 5. Error Logging ---
            Log::error('Leader registration FAILED and transaction rolled back.', [
                'error_message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user_input_email' => $request->email,
                'stack_trace' => $th->getTraceAsString()
            ]);
            
            return redirect()->back()->withInput()->withErrors('Registration failed. Please try again.');
        }
    }
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        // $emailOtp = rand(000000, 999999);
        $emailOtp = "123456";
        $request->session()->put('new_email', $request->email);
        $request->session()->put('new_otp', $emailOtp);

        // Store OTP in session (or database)
        Session::put('otp_for_' . $request->email, $emailOtp);
        Session::put('otp_expires_' . $request->email, now()->addMinutes(5));
 
        Mail::to($request->email)->send(new OtpEmail($emailOtp));
 

        return response()->json(['message' => 'OTP sent to your email address!']);
    }

    public function sendOtpPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // $emailOtp = rand(000000, 999999);
        $emailOtp = "123456";
        $request->session()->put('new_email', $request->email);
        $request->session()->put('new_otp', $emailOtp);

        // Store OTP in session (or database)
        Session::put('otp_for_' . $request->email, $emailOtp);
        Session::put('otp_expires_' . $request->email, now()->addMinutes(5));
 
        Mail::to($request->email)->send(new OtpEmail($emailOtp));
 

        return response()->json(['message' => 'OTP sent to your email address!']);
    }

    public function verifyOtp(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|min:4|max:6',
        ]);

        $storedOtp = Session::get('otp_for_' . $request->email);
        $expiry = Session::get('otp_expires_' . $request->email);

        if (!$storedOtp) {
            return response()->json([
                'status' => false,
                'message' => 'No OTP found. Please request a new one.'
            ], 422);
        }

        if (now()->greaterThan($expiry)) {
            return response()->json([
                'status' => false,
                'message' => 'OTP expired. Please request a new one.'
            ], 422);
        }

        if ($request->otp != $storedOtp) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP. Please try again.'
            ], 422);
        }

        // OTP is correct → remove it from session
        Session::forget('otp_for_' . $request->email);
        Session::forget('otp_expires_' . $request->email);

        return response()->json([
            'status' => true,
            'message' => 'OTP verified successfully!'
        ]);
    }

    public function login(){
        return view("leader.login");
    }

    public function loginStore(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $leader = User::where('email', $request->email)->first();

        if (!$leader || !Hash::check($request->password, $leader->password)) {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->withInput();
        }

        auth()->login($leader);

        return redirect()->route('leader.dashboard'); 
        
    }

    public function forgetPass(){
        return view("leader.forgetpass");
    }

    public function forgetPassStore(Request $request) {
        $request->validate([
            "email"=> "required|email",
            "password"=> "required|min:6",
        ]);
        $leader = User::where("email", $request->email)->first();
        if(!$leader){
            return redirect()->route("leader.register")->with("User Don't Exist ! Please Register First");
        }
        $leader->password = Hash::make($request->password);
        $leader->save();
        return redirect()->route('leader.login')->with('success','PassWord Updated. Please login.');    
    }



}
