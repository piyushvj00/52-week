<?php

namespace App\Console\Commands;

use App\Models\PortalSet;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendWeeklyUserMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:send-weekly-messages';
    protected $description = 'Send message to users every 7 days after their start date';


    /**
     * Execute the console command.
     */
   public function handle()
{
    $today = \Carbon\Carbon::today();

    // 1️⃣ Get portal set that is full
    $portalSet = \App\Models\PortalSet::where('is_full', 1)->first();

    if (!$portalSet || !$portalSet->start_date) {
        \Log::warning('No valid portal set found.');
        return Command::SUCCESS;
    }

    $startDate = \Carbon\Carbon::parse($portalSet->start_date);
    $daysSinceStart = $startDate->diffInDays($today);

    // 2️⃣ Message goes 5 days after start date, then every 7 days
    if ($daysSinceStart < 5) {
        // too early, do nothing
        return Command::SUCCESS;
    }

    // Check if today is exactly 5 days OR every 7 days after that
    if (($daysSinceStart - 5) % 7 !== 0) {
        return Command::SUCCESS; // not a message day
    }

    // 3️⃣ Find all groups for this portal set
    $groups = \App\Models\Group::where('portal_set_id', $portalSet->id)->get();

    // 4️⃣ Collect all group members
    $userIds = \App\Models\GroupMember::whereIn('group_id', $groups->pluck('id'))->pluck('user_id')->unique();

    // 5️⃣ Get user models
    $users = \App\Models\User::whereIn('id', $userIds)->get();

    // 6️⃣ Send message (for now just log)
    foreach ($users as $user) {
        \Log::info("Sent message to {$user->email} (PortalSet ID: {$portalSet->id})");

        // You could do: $user->notify(new WeeklyReminderNotification());
    }

    return Command::SUCCESS;
}
}
