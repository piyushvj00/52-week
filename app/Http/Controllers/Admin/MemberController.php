<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaderRequest;
use App\Models\Contribution;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = User::where('role', 3)->latest()->paginate(10);
        return view('admin.member.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaderRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $file = $request->file('profile_image');

        if (!$file) {
            return redirect()->back()->withErrors('No file uploaded.');
        }

        $destinationPath = public_path('uploads');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0775, true);
        }

        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);
        chmod($destinationPath . '/' . $fileName, 0775);

        $user->profile_image = $fileName;
        $user->role = 3;
        $user->save();
        return redirect()->route('member.index')->with('success', 'Add Leader successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = User::findOrFail($id);

        return view('admin.member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->all());
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

        $user->role = 3;
        $user->save();
        return redirect()->route('member.index')->with('success', 'Update member successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('member.index')->with('success', 'Deleted    member successfully');

    }
    public function toggleStatus(Request $request)
    {
        $user = User::where('role', 3)->find($request->id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        return response()->json($user->status);
    }
    public function groupLink($id)
    {
        $groupIds = GroupMember::where('user_id', $id)->pluck('group_id');
        $group = Group::whereIn('id', $groupIds)->latest()->paginate(10);


        return view('admin.users.groups', compact('group'));
    }
    public function viewAllNotification(Request $request)
    {
        Notification::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back(); // or return JSON if using AJAX
    }
    public function contributionList(){
        $contribution = Contribution::with('group', 'user')->latest()->paginate(10)->through(function ($data) {
        $contr = GroupMember::where('group_id', $data->group_id)
            ->where('user_id', $data->user_id)
            ->first();

        $data->contributionamount = $contr ? $contr->weekly_commitment : 0;
        return $data;
    });

        return view('admin.contribution.list', compact('contribution'));
 
    }
    public function contributionListByID($id)
{
    $group = Group::withCount('members')->findOrFail($id);
    
    $contribution = Contribution::with(['group', 'user'])
        ->where('group_id', $id)
        ->latest()
        ->paginate(10)
        ->through(function ($data) {
            $contr = GroupMember::where('group_id', $data->group_id)
                ->where('user_id', $data->user_id)
                ->first();

            $data->contributionamount = $contr ? $contr->weekly_commitment : 0;
            return $data;
        });

    // Calculate statistics
    $totalContributions = Contribution::where('group_id', $id)->count();
    $totalAmount = Contribution::where('group_id', $id)->where('status', 'completed')->sum('amount');
    $completedContributions = Contribution::where('group_id', $id)->where('status', 'completed')->count();
    $pendingContributions = Contribution::where('group_id', $id)->where('status', 'pending')->count();
    
    // Calculate progress percentage
    $progressPercentage = $group->target_amount > 0 ? 
        round(($group->current_amount / $group->target_amount) * 100, 2) : 0;

    // Get current week (you might want to calculate this based on your logic)
    $currentWeek = 1; // Replace with your week calculation logic

    return view('admin.contribution.list', compact(
        'contribution',
        'group',
        'totalContributions',
        'totalAmount',
        'completedContributions',
        'pendingContributions',
        'progressPercentage',
        'currentWeek'
    ));
}
    public function contributionStatus(Request $request){
        $contribution = Contribution::find($request->id);
        $contribution->status = $request->status;
        $contribution->save();
        return response()->json($contribution->status);
    }
    public function proceedPayment(Request $request){
        $groupMember = GroupMember::where('user_id',$request->user_id)->where('group_id',$request->group_id)->first();
        $groupMember->has_recived = true;
        $groupMember->recived_amount = $request->amount;
        $groupMember->recived_date = date('Y-m-d');
        $groupMember->save();
        return redirect()->back()->with('success', 'Member payout successfully');

    }
     public function logout()
    {
        Auth::logout();
        return redirect('/leader/login');
    }
}
