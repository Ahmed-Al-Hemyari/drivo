<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

return function (Schedule $schedule) {
    $schedule->call(function () {
        $today = now()->toDateString();

        $statuses = DB::table('booking_statuses')
            ->whereIn('name_en', ['Pending', 'Confirmed', 'Active', 'Refused', 'Expired', 'Late'])
            ->pluck('id', 'name_en')
            ->mapWithKeys(fn ($id, $name) => [strtolower($name) => $id]);

        if ($statuses->isEmpty()) return;

        DB::table('bookings')
            ->where('start_date', '<=', $today)
            ->where('booking_status_id', $statuses['confirmed'])
            ->update(['booking_status_id', $statuses['active']]);

        DB::table('bookings')
            ->where('start_date', '<', $today)
            ->where('booking_status_id', $statuses['pending'])
            ->update(['booking_status_id' => $statuses['expired']]);

        DB::table('bookings')
            ->where('end_date', '<', $today)
            ->where('booking_status_id', $statuses['active'])
            ->update(['booking_status_id' => $statuses['late']]);

    })->daily();
};
