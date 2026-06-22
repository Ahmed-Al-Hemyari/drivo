<?php

namespace Database\Seeders\Development;

use App\Models\BookingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name_en' => 'Pending',
                'name_ar' => 'تحت الإنتظار',
                'background_color' => '#FEF3C7', // Soft Amber
                'font_color' => '#92400E',       // Dark Amber
            ],
            [
                'name_en' => 'Confirmed',
                'name_ar' => 'مؤكد',
                'background_color' => '#DBEAFE', // Soft Blue
                'font_color' => '#1E40AF',       // Dark Blue
            ],
            [
                'name_en' => 'Cancelled',
                'name_ar' => 'ملغي',
                'background_color' => '#F3F4F6', // Soft Gray
                'font_color' => '#374151',       // Dark Gray
            ],
            [
                'name_en' => 'Refused',
                'name_ar' => 'مرفوض',
                'background_color' => '#FEE2E2', // Soft Red
                'font_color' => '#991B1B',       // Dark Red
            ],
            [
                'name_en' => 'Active',
                'name_ar' => 'نشط',
                'background_color' => '#D1FAE5', // Soft Emerald
                'font_color' => '#065F46',       // Dark Emerald
            ],
            [
                'name_en' => 'Expired',
                'name_ar' => 'منتهي',
                'background_color' => '#EDF2F7', // Soft Slate
                'font_color' => '#4A5568',       // Dark Slate
            ],
            [
                'name_en' => 'Completed',
                'name_ar' => 'مكتمل',
                'background_color' => '#DCFCE7', // Soft Green
                'font_color' => '#166534',       // Dark Green
            ],
            [
                'name_en' => 'Late',
                'name_ar' => 'متأخر',
                'background_color' => '#FFEDD5', // Soft Orange
                'font_color' => '#9A3412',       // Dark Orange
            ],
        ];

        BookingStatus::insert($statuses);
    }
}
