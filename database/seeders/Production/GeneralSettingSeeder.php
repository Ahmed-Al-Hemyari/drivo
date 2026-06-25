<?php

namespace Database\Seeders\Production;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'name',
                'value' => 'Drivo',
                'value_ar' => 'دريفو',
                'is_published' => true
            ],
            [
                'key' => 'business_name',
                'value' => 'Drivo Company',
                'value_ar' => 'شركة دريفو',
                'is_published' => true
            ],
            [
                'key' => 'business_full_name',
                'value' => 'Drivo Company for Car Renting',
                'value_ar' => 'شركة دريفو لتأجير السيارات',
                'is_published' => true
            ],
            [
                'key' => 'website_url',
                'value' => 'drivo.com',
                'value_ar' => 'drivo.com',
                'is_published' => true
            ],
            [
                'key' => 'website_url_2',
                'value' => 'drivo.sa',
                'value_ar' => 'drivo.sa',
                'is_published' => true
            ],
            [
                'key' => 'x_url',
                'value' => 'x.com/DrivoCompany',
                'value_ar' => 'x.com/DrivoCompany',
                'is_published' => true
            ],
            [
                'key' => 'instagram_url',
                'value' => 'www.instagram.com/DrivoCompany',
                'value_ar' => 'www.instagram.com/DrivoCompany',
                'is_published' => true
            ],
            [
                'key' => 'fb_url',
                'value' => 'www.facebook.com/DrivoCompany',
                'value_ar' => 'www.facebook.com/DrivoCompany',
                'is_published' => true
            ],
            [
                'key' => 'snapchat_url',
                'value' => 'www.snapchat.com/add/DrivoCompany',
                'value_ar' => 'www.snapchat.com/add/DrivoCompany',
                'is_published' => true
            ],
            [
                'key' => 'tiktok_url',
                'value' => 'tiktok.com/@drivocompany',
                'value_ar' => 'tiktok.com/@drivocompany',
                'is_published' => true
            ],
            [
                'key' => 'primary_color',
                'value' => '#FF5A00',
                'value_ar' => '#FF5A00',
                'is_published' => true
            ],
            [
                'key' => 'VAT_percentage',
                'value' => '0',
                'value_ar' => '0',
                'is_published' => true
            ]
        ];

        \App\Models\GeneralSetting::insert($settings);
    }
}
