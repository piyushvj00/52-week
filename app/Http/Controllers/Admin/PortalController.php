<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePortalRequest;
use App\Models\Group;
use App\Models\Portal;
use App\Models\PortalSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portal = PortalSet::latest()->paginate(10);
        return view("admin.portal.index", compact("portal"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.portal.create");
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StorePortalRequest $request)
{
    try {
        DB::beginTransaction();
        $portalSet = PortalSet::where('is_active',1)->first();
        if($portalSet){
            $group = Group::where('portal_set_id',$portalSet->id)->count();
            if ($group < 52) {
            return redirect()->back()->with('error', 'Previous portal is not full !');
                
            }
        }
        // 1. Create Portal Set
        $portalSet = new PortalSet();
        $portalSet->fill($request->all());
        $portalSet->save();

        $logoPath = null;
        $videoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('portal-logos', 'public');
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('portal-videos', 'public');
        }

        // 2. Create Reserved Groups (1–5)
        $reservedGroups = [
            1 => 'Emergency Fund',
            2 => 'Ekero Partners Platform',
            3 => 'Presidential Group',
            4 => 'Emergency Partners Group',
            5 => 'Reserved Group'
        ];

        foreach ($reservedGroups as $number => $name) {
            Group::create([
                'portal_set_id'       => $portalSet->id,
                'name'                => $name,
                'group_number'        => $number,
                'leader_id'           => 0,
                'current_amount'      => 0,
                'project_name'        => $name,
                'project_description' => 'Reserved group: '.$name,
                'logo_path'           => $logoPath,
                'video_path'          => $videoPath,
                'is_active'           => true,
                'target_amount'           => $request->target_amount
            ]);
        }

        DB::commit();
        return redirect()->back()->with('success', 'Portal Set and Reserved Groups created successfully.');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
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
        $portal = PortalSet::findOrFail($id);
    
        return view('admin.portal.edit', compact('portal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
                $portal =  PortalSet::findOrFail($id);
        $portal->fill($request->all());
        $portal->save();
        return redirect()->route('portal.index')->with('success','Update portal successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PortalSet::destroy($id);
        return redirect()->route('portal.index')->with('success','Deleted group successfully');

    }
 
   
}
