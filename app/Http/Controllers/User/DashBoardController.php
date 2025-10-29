<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\PortalSet;
use App\Models\Leader;
use App\Models\User;
use App\Models\Contribution;
use Carbon\Carbon;
use App\Models\Notification;




class DashBoardController extends Controller
{

    public function dashboard(){
        $user = Auth::user();
        $groupId = GroupMember::where('user_id',$user->id)->pluck('group_id');
        $group = Group::where('id',$groupId)->first();
        $groupMembers = GroupMember::where('group_id',$groupId)->get();
        $portal = PortalSet::where('id', $group->portal_set_id)->first();
        $leader = User::where('id', $group->leader_id)->first();
        $contributions = Contribution::where('user_id', $user->id)->latest()->get();
        $weeklyCommitment = GroupMember::where('user_id', $user->id)->first()->weekly_commitment;

        // dd($group , $portal , $contributions , $weeklyCommitment);

        return view("user.dashboard", compact('user',"group" , "portal", "leader" , "groupMembers" , "contributions",'weeklyCommitment'));

    }

    public function readAllNotification(Request $request){

        Notification::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);


        return redirect()->back(); // or return JSON if using AJAX

    }

    public function userProfile(Request $request){
        $user = Auth::user();
        return view("user.profile" , compact("user"));
    }

    public function userUpdateProfile(Request $request) {
        $user = Auth::user();
         $file = $request->file('profile_image');
 
            if ($file) {
                $destinationPath = public_path('uploads');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true);
                }
    
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $fileName);
                chmod($destinationPath . '/' . $fileName, 0775);
    
                $user->profile_image = $fileName;
            }
        $user->name = $request->name;
        $user->address = $request->address;
        $user->save();

        return redirect()->route("user.dashboard")->with('success','Profile Updated successsfully');     

    }

    public function myContribution() {
        $user = Auth::user();
        $groupId = GroupMember::where('user_id',$user->id)->pluck('group_id');
        $group = Group::where('id',$groupId)->first();
        $groupMembers = GroupMember::where('group_id',$groupId)->get();
        $portal = PortalSet::where('id', $group->portal_set_id)->first();
        $leader = User::where('id', $group->leader_id)->first();
        $contributions = Contribution::where('user_id', $user->id)->latest()->get();
        $weeklyCommitment = GroupMember::where('user_id', $user->id)->first()->weekly_commitment;

        return view('user.contribution', compact('user',"group" , "portal", "leader" , "groupMembers" , "contributions",'weeklyCommitment'));
    }

    public function myContributionPay(Request $request) {
        $user = Auth::User();
        $request->validate([
        'group_id' => 'required|exists:groups,id',
        'user_id' => 'required|exists:users,id',
        'amount' => 'required|numeric|min:1',       
        'transaction_id' => 'required|string|max:255',
        'week_number' => 'required|integer|min:1',
        ]);

         // ✅ Create and save contribution
        $contribution = new Contribution();
        $contribution->group_id = $request->group_id;
        $contribution->user_id = $request->user_id;
        $contribution->week_number = $request->week_number;
        $contribution->amount = $request->amount;
        $contribution->transaction_id = $request->transaction_id;
        $contribution->contribution_date = Carbon::now(); // current date
        $contribution->status = 'pending'; // or 'completed' if you want default
        $contribution->payment_method = 'manual'; // or get from request if available
        $contribution->save();

        $group = Group::where('id',$request->group_id)->first();

         $this->createNotification(
                "Amount for week no.".$request->week_number . " paid successfully.",
                $user->id,
                $user->id
            );

        return redirect()->route('user.my.contribution')->with('success',"successfully contributed in group");
    }

    public function PaymentRecieptDownload()
    {
        $user = auth()->user();
        $contributions = Contribution::with('group')
            ->where('user_id', $user->id)
            ->orderBy('week_number', 'desc')
            ->get();
    
        // Calculate statistics
        $totalPayments = $contributions->count();
        $totalAmount = $contributions->sum('amount');
        $completedPayments = $contributions->where('status', 'completed')->count();
        // Get user's weekly commitment from group_members table
        $weeklyCommitment = GroupMember::where('user_id', $user->id)
            ->value('weekly_commitment') ?? 0;
    
        // Calculate current week (you might have your own logic for this)
        $currentWeek = 1; // Replace with your week calculation
    
        return view('user.payment_reciepts', compact(
            'contributions',
            'totalPayments',
            'totalAmount',
            'completedPayments',
            'weeklyCommitment',
            'currentWeek'
        ));
    }

        
    


}
