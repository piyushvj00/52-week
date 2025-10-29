<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contribution;
use App\Models\Ebook;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\News;
use App\Models\PortalSet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $portalSet = PortalSet::where('is_active',1)->first();
        $groupCount = Group::where('portal_set_id',$portalSet->id)->count();
        $group = Group::where('portal_set_id',$portalSet->id)->pluck('id');
        $groupMember = GroupMember::whereIn('group_id',$group)->count();
        $contribution = Contribution::whereIn('group_id',$group)->sum('amount');
        return view('admin.dashboard.index',compact('groupCount','contribution','groupMember','portalSet'));

    }
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
