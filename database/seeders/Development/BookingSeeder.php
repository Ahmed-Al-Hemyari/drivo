<?php

namespace Database\Seeders\Development;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            // --- PAST BOOKINGS (Completed & Cancelled) ---
            [
                'user_id' => 3,
                'car_id' => 1,
                'start_date' => '2026-05-01 09:00:00',
                'end_date' => '2026-05-05 17:00:00',
                'status' => 'completed',
                'rated' => true, // Perfect for testing your average rating accessor
            ],
            [
                'user_id' => 4,
                'car_id' => 2,
                'start_date' => '2026-05-12 10:30:00',
                'end_date' => '2026-05-15 10:30:00',
                'status' => 'completed',
                'rated' => false, // Completed but user skipped reviewing
            ],
            [
                'user_id' => 5,
                'car_id' => 3,
                'start_date' => '2026-05-20 14:00:00',
                'end_date' => '2026-05-22 14:00:00',
                'status' => 'cancelled', // Tests how system handles cancellations
                'rated' => false,
            ],
            [
                'user_id' => 3,
                'car_id' => 4,
                'start_date' => '2026-06-01 08:00:00',
                'end_date' => '2026-06-05 12:00:00',
                'status' => 'completed',
                'rated' => true,
            ],

            // --- CURRENT BOOKINGS (Active Right Now - June 2026) ---
            [
                'user_id' => 5,
                'car_id' => 1, // Car 1 is now out on another trip
                'start_date' => '2026-06-08 09:00:00',
                'end_date' => '2026-06-13 16:00:00',
                'status' => 'active', // Will trip your status accessor to 'rented'
                'rated' => false,
            ],
            [
                'user_id' => 4,
                'car_id' => 6,
                'start_date' => '2026-06-09 11:00:00',
                'end_date' => '2026-06-11 11:00:00',
                'status' => 'active',
                'rated' => false,
            ],

            // --- FUTURE BOOKINGS (Upcoming) ---
            [
                'user_id' => 3,
                'car_id' => 8,
                'start_date' => '2026-06-15 10:00:00',
                'end_date' => '2026-06-18 10:00:00',
                'status' => 'confirmed', // Paid and ready for pickup next week
                'rated' => false,
            ],
            [
                'user_id' => 4,
                'car_id' => 7,
                'start_date' => '2026-06-22 09:00:00',
                'end_date' => '2026-06-25 18:00:00',
                'status' => 'pending', // Awaiting admin approval
                'rated' => false,
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}
