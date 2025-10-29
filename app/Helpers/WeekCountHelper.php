<?php

use Carbon\Carbon;

if (!function_exists('weekCount')) {


    /**
     * Get the number of weeks passed from the given start date until today
     *
     * @param string|Carbon $startDate
     * @return int
     */
    function weekCount($startDate)
    {
        // Convert start date to Carbon instance
        $startDate = Carbon::parse($startDate);

        // Get current date
        $today = Carbon::today();

        // Calculate difference in days
        $days = $startDate->diffInDays($today);

        // Calculate week number (1 week = 7 days)
        $weekNumber = (int) ceil(($days + 1) / 7); // +1 to include the start day in week 1

        return $weekNumber;
    }
}

