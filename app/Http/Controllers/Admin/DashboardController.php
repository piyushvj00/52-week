<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contribution;
use App\Models\Ebook;
use App\Models\Group;
use App\Models\HelpSupport;
use App\Models\GroupMember;
use App\Models\News;
use App\Models\PortalSet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
       $portalSet = PortalSet::where('is_active', 1)->first();

$groupCount = $portalSet ? Group::where('portal_set_id', $portalSet->id)->count() : 0;

$groupIds = $portalSet ? Group::where('portal_set_id', $portalSet->id)->pluck('id') : collect();

$groupMember = $groupIds->isNotEmpty() ? GroupMember::whereIn('group_id', $groupIds)->count() : 0;
$contribution = $groupIds->isNotEmpty() ? (float) (Contribution::whereIn('group_id', $groupIds)->sum('amount') ?? 0) : 0;
        return view('admin.dashboard.index', compact('groupCount', 'contribution', 'groupMember', 'portalSet'));

    }
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
      public function helpSupport()
    {
        $helpSupport = HelpSupport::first();
        return view('admin.dashboard.help_support' , compact('helpSupport'));
    }
 
     public function helpSupportStore(Request $request)
    {
 
        try {
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'support_email' => 'required|email|max:255',
                'support_phone' => 'required|string|max:20',
                'support_days' => 'required|string|max:100',
                'support_start_time' => 'required|date_format:H:i',
                'support_end_time' => 'required|date_format:H:i|after:support_start_time',
            ], [
                'support_email.required' => 'Support email address is required',
                'support_email.email' => 'Please enter a valid email address',
                'support_phone.required' => 'Support phone number is required',
                'support_days.required' => 'Please specify support available days',
                'support_start_time.required' => 'Support start time is required',
                'support_end_time.required' => 'Support end time is required',
                'support_end_time.after' => 'End time must be after start time',
            ]);
 
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Please fix the errors below.');
            }
 
            // Use transaction for data consistency
            DB::transaction(function () use ($request) {
                // Check if support settings already exist
                $supportSetting = HelpSupport::first();
                $time = $request->support_start_time . ' - ' . $request->support_end_time;
 
                if ($supportSetting) {
                    // Update existing settings
                    $supportSetting->update([
                        'email' => $request->support_email,
                        'phone' => $request->support_phone,
                        'day' => $request->support_days,
                        'time' => $time,
                    ]);
                } else {
                    // Create new settings
                    HelpSupport::create([
                        'email' => $request->support_email,
                        'phone' => $request->support_phone,
                        'day' => $request->support_days,
                        'time' => $time,
                    ]);
                }
            });
 
 
            return redirect()
                ->back()
                ->with('success', 'Support settings updated successfully!');
 
        } catch (\Exception $e) {
            \Log::error('Support settings update failed: ' . $e->getMessage());
           
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update support settings. Please try again.');
        }
    }
}
