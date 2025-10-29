<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminLeaderRequest;
use App\Http\Requests\StoreLeaderRequest;
use App\Models\Group;
use App\Models\PortalSet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function PHPUnit\Framework\returnArgument;

class LeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leader = User::with('group')->where('role', 2)->latest()->paginate(10);
        return view('admin.users.index', compact('leader'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminLeaderRequest $request)
    {
        try {
            DB::beginTransaction();
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
            $user->role = 2;
            $user->save();

            $logoPath = null;
            $videoPath = null;

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('portal-logos', 'public');
            }

            if ($request->hasFile('video')) {
                $videoPath = $request->file('video')->store('portal-videos', 'public');
            }

            $portalSet = PortalSet::where('is_active', 1)->first();

            Group::where('portal_set_id', $portalSet->id)
                ->whereBetween('group_number', [6, 52])
                ->decrement('group_number');

            $names = [
                'Mercury',
                'Venus',
                'Jupiter',
                'Saturn',
                'Uranus',
                'Neptune',
                'Pluto',
                'Sky',
                'Moon',
                'Sun',
                'Heaven'
            ];

            $totalGroups = Group::where('portal_set_id', $portalSet->id)
                ->where('group_number', '>=', 6) // exclude reserved 1–5
                ->count();

            $nameIndex = $totalGroups % count($names);
            $cycle = intdiv($totalGroups, count($names));

            $baseName = $names[$nameIndex];
            $groupName = $cycle > 0 ? $baseName . $cycle : $baseName;
            $inviteLink = Str::uuid()->toString();


            $group = Group::create([
                'portal_set_id' => $portalSet->id,
                'target_amount' => $portalSet->target_amount,
                'name' => $groupName,
                'group_number' => 52,
                'leader_id' => $user->id,
                'current_amount' => 0,
                'project_name' => $request->project_name ?? $groupName,
                'project_description' => $request->project_description ?? "Auto-generated group",
                'logo_path' => $logoPath,
                'video_path' => $videoPath,
                'invite_link' => $inviteLink,
                'is_active' => true
            ]);
              $this->createNotification(
                $request->name . " registered successfully",
                $user->id,
                auth()->user()->id
            );

            DB::commit();
            return redirect()->route('leader.index')->with('success', 'Add Leader successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
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
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
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

        $user->role = 2;
        $user->save();
        return redirect()->route('leader.index')->with('success', 'Update Leader successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('leader.index')->with('success', 'Deleted    Leader successfully');

    }
    public function toggleStatus(Request $request)
    {
        $user = User::where('role', 2)->find($request->id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        return response()->json($user->status);
    }
    public function groupLink($id)
    {
        $group = Group::where('leader_id', $id)->latest()->first();
        $portalSet = PortalSet::find($group->portal_set_id);
        return view('admin.users.groups', compact('group', 'portalSet'));
    }
}
