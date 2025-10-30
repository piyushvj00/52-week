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
use App\Models\Transaction;
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

        $weeklyContributions = [];
        $weeklyRevenue = [];
        $weekLabels = [];

        for ($i = 3; $i >= 0; $i--) {
            $weekStart = now()->subWeeks($i)->startOfWeek();
            $weekEnd = now()->subWeeks($i)->endOfWeek();
            $weekNumber = now()->subWeeks($i)->week;

            $weekContributions = $groupIds->isNotEmpty() ?
                Contribution::whereIn('group_id', $groupIds)
                    ->whereBetween('contribution_date', [$weekStart, $weekEnd])
                    ->sum('amount') : 0;

            $weekRevenue = $groupIds->isNotEmpty() ?
                Transaction::whereIn('group_id', $groupIds)
                    ->whereBetween('paid_date', [$weekStart, $weekEnd])
                    ->sum('payout_amount') : 0;

            $weeklyContributions[] = (float) $weekContributions;
            $weeklyRevenue[] = (float) $weekRevenue;
            $weekLabels[] = 'Week ' . $weekNumber;
        }

        // Member Status Data
        $activeMembers = $groupIds->isNotEmpty() ?
            GroupMember::whereIn('group_id', $groupIds)->where('is_active', true)->count() : 0;

        $inactiveMembers = $groupIds->isNotEmpty() ?
            GroupMember::whereIn('group_id', $groupIds)->where('is_active', false)->count() : 0;

        $pendingMembers = $groupIds->isNotEmpty() ?
            GroupMember::whereIn('group_id', $groupIds)->where('has_recived', false)->count() : 0;

        // Group Performance Data
        $groupPerformance = [];
        if ($groupIds->isNotEmpty()) {
            $groups = Group::whereIn('id', $groupIds)
                ->withSum('contributions', 'amount')
                ->get();

            foreach ($groups as $group) {
                $completionRate = $group->target_amount > 0 ?
                    ($group->contributions_sum_amount / $group->target_amount) * 100 : 0;

                $groupPerformance[] = [
                    'name' => $group->name,
                    'completion_rate' => round($completionRate, 2),
                    'target_amount' => $group->target_amount,
                    'current_amount' => $group->contributions_sum_amount ?? 0
                ];
            }
        }

        $recentActivities = collect();

        // Get recent group members (last 5)
        $recentMembers = GroupMember::with(['user', 'group'])
            ->whereIn('group_id', $groupIds)
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($member) {
                return [
                    'type' => 'member_joined',
                    'title' => 'New Member Joined',
                    'description' => $member->user->name . ' joined ' . $member->group->name,
                    'icon' => 'user-plus',
                    'icon_color' => 'primary',
                    'time' => $member->created_at,
                    'amount' => null
                ];
            });

        // Get recent contributions (last 5)
        $recentContributions = Contribution::with(['user', 'group'])
            ->whereIn('group_id', $groupIds)
            ->where('status', 'completed')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($contribution) {
                return [
                    'type' => 'contribution',
                    'title' => 'Contribution Received',
                    'description' => '$' . number_format($contribution->amount, 2) . ' from ' . $contribution->user->name,
                    'icon' => 'dollar-sign',
                    'icon_color' => 'success',
                    'time' => $contribution->created_at,
                    'amount' => $contribution->amount
                ];
            });

        // Get recent groups created (last 2)
        $recentGroups = Group::whereIn('id', $groupIds)
            ->latest()
            ->take(2)
            ->get()
            ->map(function ($group) {
                return [
                    'type' => 'group_created',
                    'title' => 'New Group Created',
                    'description' => $group->name . ' started',
                    'icon' => 'users',
                    'icon_color' => 'warning',
                    'time' => $group->created_at,
                    'amount' => null
                ];
            });

        // Get target achievements
        $targetAchievements = Group::whereIn('id', $groupIds)
            ->where('current_amount', '>=', \DB::raw('target_amount * 0.8')) // 80% or more completion
            ->latest()
            ->take(2)
            ->get()
            ->map(function ($group) {
                $completion = ($group->current_amount / $group->target_amount) * 100;
                return [
                    'type' => 'target_achieved',
                    'title' => 'Target Progress',
                    'description' => $group->name . ' reached ' . round($completion, 1) . '% of target',
                    'icon' => 'target',
                    'icon_color' => 'info',
                    'time' => $group->updated_at,
                    'amount' => $completion
                ];
            });

        // Merge all activities and sort by time
        $recentActivities = $recentMembers
            ->merge($recentContributions)
            ->merge($recentGroups)
            ->merge($targetAchievements)
            ->sortByDesc('time')
            ->take(6); // Limit to 6 most recent activities

        return view('admin.dashboard.index', compact(
            'groupCount',
            'contribution',
            'groupMember',
            'portalSet',
            'weeklyContributions',
            'weeklyRevenue',
            'weekLabels',
            'activeMembers',
            'inactiveMembers',
            'pendingMembers',
            'groupPerformance',
            'recentActivities'
        ));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
    public function helpSupport()
    {
        $helpSupport = HelpSupport::first();
        return view('admin.dashboard.help_support', compact('helpSupport'));
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
