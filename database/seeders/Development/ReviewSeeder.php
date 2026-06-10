<?php

namespace Database\Seeders\Development;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'booking_id' => 1,
                'rate' => 5,
                'comment' => 'The car was exceptionally clean, smelling fresh, and highly fuel-efficient. The pickup and drop-off process was incredibly smooth!',
            ],
            [
                'booking_id' => 4,
                'rate' => 4,
                'comment' => 'سيارة ممتازة ومريحة جداً في السفر الطويل. التكييف ممتاز ولكن استلام السيارة تأخر حوالي 10 دقائق عن الموعد.',
            ],
        ];

        foreach ($reviews as $review) {
            \App\Models\Review::create($review);
        }
    }
}
