<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Notification;
use App\Models\PortalSet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DashBoardController extends Controller
{

    public function dashboard()
    {
        $portalSet = PortalSet::where('is_active',1)->first();
        $group = Group::where('leader_id',auth()->user()->id)->first();
        $groupMember = GroupMember::where('group_id',$group->id)->count();
        $contribution = Contribution::whereIn('group_id',$group)->sum('amount');
 
        return view("leader.dashboard",compact('portalSet','contribution','groupMember'));
    }
    public function group()
    {
        $groups = Group::where('leader_id', auth()->user()->id)->latest()->paginate(10);
        $member = User::where('role', 3)->latest()->get();
        return view('leader.group.index', compact('groups', 'member'));
    }
    public function groupCreate()
    {
        $leader = User::where('role', 2)->where('status', 1)->latest()->get();
        $portalSets = PortalSet::where('is_active', 1)->latest()->get();
        return view("leader.group.create", compact('leader', 'portalSets'));

    }
    public function assignMembers(Request $request)
    {
        $groupMember = GroupMember::where('group_id', $request->group_id)->where('user_id', $request->user_id)->first();
        if ($groupMember) {
            return redirect()->back()->with('error', 'Member alredy assign in this group');
        }
        $group = Group::find($request->group_id);

        $groupMember = new GroupMember();
        $groupMember->user_id = $request->user_id;
        $groupMember->group_id = $request->group_id;
        $groupMember->weekly_commitment = $request->weekly_commitment;
        $shares = ($group->target_amount)/($request->weekly_commitment);
        $groupMember->group_sare = $shares;
        $groupMember->save();
        return redirect()->back()->with('success', 'Member  assign successfully');

    }
    public function groupMember($id)
    {
        $group = Group::findOrFail($id);
        $groupMember = GroupMember::where('group_id', $id)->latest()->paginate(10);
        return view("leader.group.assign-member", compact('groupMember', 'group'));

    }
    public function destroyMember($portalId, $userId)
    {
        $groupMember = GroupMember::where('user_id', $portalId)->where('group_id', $userId)->first();

        if ($groupMember) {
            $groupMember->delete();
            return back()->with('success', 'Member removed successfully.');
        }

        return back()->with('error', 'Member not found in this group.');
    }
    public function memberDetails($id)
    {
        $user = User::findOrFail($id);
        $groups = Group::where('leader_id', auth()->user()->id)->latest()->paginate(10);
        return view('leader.group.member-details', compact('user', 'groups'));
    }
    public function leaderProfile(Request $request)
    {
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
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route("leader.dashboard")->with('success', 'Profile Updated successsfully');

    }
    public function leaderUpdateProfile()
    {
        $user = User::find(auth()->user()->id);
        return view('leader.profile', compact('user'));
    }
    public function editGroup($id)
    {
        $groups = Group::findOrFail($id);
        return view('leader.group.edit', compact('groups'));
    }
    public function updateGroup(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $logo = $request->file('logo');

        if ($logo) {
            $destinationPath = public_path('uploads');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }

            $fileName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move($destinationPath, $fileName);
            chmod($destinationPath . '/' . $fileName, 0775);
            $group->logo_path = $fileName;
        }
        $video = $request->file('video');

        if ($video) {
            $destinationPath = public_path('uploads');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }

            $fileName = time() . '.' . $video->getClientOriginalExtension();
            $video->move($destinationPath, $fileName);
            chmod($destinationPath . '/' . $fileName, 0775);

            $group->video_path = $fileName;
        }
        $group->project_description = $request->project_description;
        $group->project_name = $request->project_name;
        $group->save();
        return redirect()->back()->with('success', 'Group Updated successsfully');


    }

    public function contribution()
    {        $groups = Group::where('leader_id', auth()->user()->id)->latest()->paginate(10);
        $member = User::where('role', 3)->latest()->get();
        return view('leader.contribution.index',compact('groups','member'));
    }
    public function readAllNotification(Request $request){

      Notification::where('receiver_id', Auth::id())
                    ->where('is_read', false)
                    ->update(['is_read' => true]);

        return redirect()->back(); // or return JSON if using AJAX

}

    public function contributionList($id){

    
     $contribution = Contribution::with('group', 'user')->where('group_id',$id)->latest()->paginate(10)->through(function ($data) {
        $contr = GroupMember::where('group_id', $data->group_id)
            ->where('user_id', $data->user_id)
            ->first();

        $data->contributionamount = $contr ? $contr->weekly_commitment : 0;
        return $data;
    });
        return view('leader.contribution.list', compact('contribution'));
}
 public function contributionStatus(Request $request){
        $contribution = Contribution::find($request->id);
        $contribution->status = $request->status;
        $contribution->save();
        return response()->json($contribution->status);
    }
}
