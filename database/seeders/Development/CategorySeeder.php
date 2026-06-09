<?php

namespace Database\Seeders\Development;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'Sedan',
                'name_ar' => 'سيدان',
            ],
            [
                'name_en' => 'SUV',
                'name_ar' => 'اس يو ڤي',
            ],
            [
                'name_en' => 'Coupe',
                'name_ar' => 'كوبي',
            ],
            [
                'name_en' => 'Hatchback',
                'name_ar' => 'هاتشباك',
            ],
            [
                'name_en' => 'Truck',
                'name_ar' => 'شاحنة',
            ],
            [
                'name_en' => 'Van',
                'name_ar' => 'ڤان',
            ],
            [
                'name_en' => 'Pickup',
                'name_ar' => 'بيك أب',
            ],
            [
                'name_en' => 'Sports Car',
                'name_ar' => 'سيارة رياضية',
            ],
            [
                'name_en' => 'Luxury Car',
                'name_ar' => 'سيارة فاخرة',
            ],
            [
                'name_en' => 'Electric Car',
                'name_ar' => 'سيارة كهربائية',
            ],
            [
                'name_en' => 'Hybrid Car',
                'name_ar' => 'سيارة هجينية',
            ],
        ];

        Category::insert($categories);
    }
}
