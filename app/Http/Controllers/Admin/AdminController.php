<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Models\Contribution;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\PortalSet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::with('leader')->latest()->paginate(10);
        return view("admin.groups.index", compact("groups"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leader = User::where('role', 2)->where('status', 1)->latest()->get();
        $portalSets = PortalSet::where('is_active', 1)->latest()->get();
        return view("admin.groups.create", compact('leader', 'portalSets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        try {
            DB::beginTransaction();

            $logoPath = null;
            $videoPath = null;

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('portal-logos', 'public');
            }

            if ($request->hasFile('video')) {
                $videoPath = $request->file('video')->store('portal-videos', 'public');
            }

            // $inviteLink = Str::uuid()->toString();

            $portal = new Group();
            $portal->fill([
                'portal_set_id' => $request->portal_set_id,
                'name' => $request->name,
                'group_number' => $request->group_number,
                'leader_id' => $request->leader_id,
                'target_amount' => $request->target_amount,
                'current_amount' => 0,
                'project_name' => $request->project_name,
                'project_description' => $request->project_description,
                'logo_path' => $logoPath,
                'video_path' => $videoPath,
                'is_active' => true
            ]);

            $portal->save();

            DB::commit();
            return redirect()->route('groups.index')->with('success', 'Portal created successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create portal: ' . $th->getMessage());
        }
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
        $leader = User::where('role', 2)->where('status', 1)->latest()->get();
        $portalSets = PortalSet::where('is_active', 1)->latest()->get();
        return view('admin.groups.edit', compact('groups', 'leader', 'portalSets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $group = Group::findOrFail($id);
        $group->fill($request->all());
        $group->total_members = $request->total_cycles;
        $group->save();
        return redirect()->route('groups.index')->with('success', 'Update group successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Group::destroy($id);
        return redirect()->route('groups.index')->with('success', 'Deleted group successfully');

    }
    public function assignMember($id)
    {
        $group = Group::findOrFail($id);
        $groupPortal = PortalSet::findOrFail($group->portal_set_id);

        $groupMember = GroupMember::with('member')
            ->where('group_id', $id)
            ->paginate(10);

        // Transform the paginated items
        $groupMember->getCollection()->transform(function ($member) use ($groupPortal) {
            $member->amountt = $member->weekly_commitment * $groupPortal->total_portals;
            return $member;
        });
        $member = User::where('role', 3)->where('status', 1)->latest()->get();
        return view('admin.groups.assign-member', compact('group', 'member', 'groupMember'));

    }
    public function assignMemberAdd(Request $request)
    {
        try {
            DB::beginTransaction();
            $groupMember = GroupMember::where('group_id', $request->group_id)->where('user_id', $request->user_id)->first();
            if ($groupMember) {
                return redirect()->back()->with('error', 'Member alredy assign in this group');
            }

            $groupMember = GroupMember::where('id', operator: $request->group_member_id)->where('group_id', $request->group_id)->update(['user_id' => $request->user_id]);
            $group = Group::findOrFail($request->group_id);
            for ($i = 0; $i < $group->total_cycles; $i++) {
                $contribution = new Contribution();
                $contribution->amount = $group->contribution_amount;
                $contribution->user_id = auth()->user()->id;
                $contribution->group_id = $group->id;
                $contribution->date = $group->id;
                $contribution->status = 0;
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to assign member: ' . $th->getMessage());

        }
        return redirect()->back()->with('success', 'Assign member successfully');

    }
}
