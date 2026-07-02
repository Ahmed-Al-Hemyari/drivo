<?php

namespace Database\Seeders\Production;

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
                'icon' => 'uploads/img/categories/sedan.png'
            ],
            [
                'name_en' => 'SUV',
                'name_ar' => 'اس يو ڤي',
                'icon' => 'uploads/img/categories/suv.png'
            ],
            [
                'name_en' => 'Coupe',
                'name_ar' => 'كوبي',
                'icon' => 'uploads/img/categories/coupe.png'
            ],
            [
                'name_en' => 'Hatchback',
                'name_ar' => 'هاتشباك',
                'icon' => 'uploads/img/categories/hatchback.png'
            ],
            [
                'name_en' => 'Truck',
                'name_ar' => 'شاحنة',
                'icon' => 'uploads/img/categories/truck.png'
            ],
            [
                'name_en' => 'Van',
                'name_ar' => 'ڤان',
                'icon' => 'uploads/img/categories/van.png'
            ],
            [
                'name_en' => 'Pickup',
                'name_ar' => 'بيك أب',
                'icon' => 'uploads/img/categories/pickup.png'
            ],
            [
                'name_en' => 'Sports Car',
                'name_ar' => 'سيارة رياضية',
                'icon' => 'uploads/img/categories/sports-car.png'
            ],
            [
                'name_en' => 'Luxury Car',
                'name_ar' => 'سيارة فاخرة',
                'icon' => 'uploads/img/categories/luxury-car.png'
            ],
            [
                'name_en' => 'Electric Car',
                'name_ar' => 'سيارة كهربائية',
                'icon' => 'uploads/img/categories/electric-car.png'
            ],
            [
                'name_en' => 'Hybrid Car',
                'name_ar' => 'سيارة هجينية',
                'icon' => 'uploads/img/categories/hybrid-car.png'
            ],
        ];

        Category::insert($categories);
    }
}
