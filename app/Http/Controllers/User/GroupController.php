<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\Group;
use App\Models\GroupChat;
use App\Models\GroupMember;
use App\Models\PortalSet;
use App\Models\User;
use App\Models\Contribution;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function group()
    {
        $groupIds = GroupMember::where('user_id', auth()->user()->id)->pluck('group_id');
        $group = Group::whereIn('id', $groupIds)->latest()->paginate(10);
        return view('user.group.index', compact('group'));
    }

    public function groupDetails()
    {
        $user = Auth::user();
        $groupId = GroupMember::where('user_id', $user->id)->pluck('group_id');
        $groupMembers = GroupMember::where('group_id', $groupId)->get();
        $group = Group::where('id', $groupId)->first();
        $portal = PortalSet::where('id', $group->portal_set_id)->first();
        $leader = User::where('id', $group->leader_id)->first();
        $contributions = Contribution::where('user_id', $user->id)->latest()->get();
        $weeklyCommitment = GroupMember::where('user_id', $user->id)->first()->weekly_commitment;
        return view('user.group.details', compact("user","group", "portal", "leader", "groupMembers", "contributions"));
    }

    public function groupMember()
    {
        $groupId = GroupMember::where('user_id', auth()->user()->id)->pluck('group_id');
        $groupMembers = GroupMember::where('group_id', $groupId)->get();

        return view('user.group.groupmember', compact('groupMembers'));
    }

    // public function groupDetails(){
    //     return view('user.group.details');
    // }
    public function index(Group $group)
    {
        // check if user is member
        $isMember = $group->members()->where('user_id', Auth::id())->exists();
        if (!$isMember) {
            abort(403, 'You are not a member of this group');
        }

        return view('user.chat', compact('group'));
    }

    public function store(Request $request, Group $group)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $isMember = $group->members()->where('user_id', Auth::id())->exists();
        if (!$isMember) {
            return response()->json(['error' => 'You are not a member of this group'], 403);
        }

        $chat = GroupChat::create([
            'group_id' => $group->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return response()->json($chat);
    }

    public function messages(Group $group)
    {
        $isMember = $group->members()->where('user_id', Auth::id())->exists();
        if (!$isMember) {
            return response()->json(['error' => 'You are not a member of this group'], 403);
        }

        $chats = $group->chats()->with('user')->take(50)->get();
        return response()->json($chats);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/user/login');
    }

}
