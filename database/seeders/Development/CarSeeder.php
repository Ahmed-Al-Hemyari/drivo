<?php

namespace Database\Seeders\Development;
namespace Database\Seeders\Development;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'name_en' => 'Camry',
                'name_ar' => 'كامري',
                'brand_id' => 1,
                'category_id' => 1,
                'daily_price' => 150,
            ],
            [
                'name_en' => 'Civic',
                'name_ar' => 'سيفيك',
                'brand_id' => 2,
                'category_id' => 1,
                'daily_price' => 100,
            ],
            [
                'name_en' => 'Corolla',
                'name_ar' => 'كورولا',
                'brand_id' => 1,
                'category_id' => 1,
                'daily_price' => 100,
            ],
            [
                'name_en' => 'Avalon',
                'name_ar' => 'أفالون',
                'brand_id' => 1,
                'category_id' => 9,
                'daily_price' => 180,
            ],
            [
                'name_en' => 'Accord',
                'name_ar' => 'آكورد',
                'brand_id' => 2,
                'category_id' => 1,
                'daily_price' => 120,
            ],
            [
                'name_en' => 'Explorer',
                'name_ar' => 'إكسبلورر',
                'brand_id' => 3,
                'category_id' => 2,
                'daily_price' => 250,
            ],
            [
                'name_en' => 'Tahoe',
                'name_ar' => 'تاهو',
                'brand_id' => 4,
                'category_id' => 2,
                'daily_price' => 300,
            ],
            [
                'name_en' => 'Phantom',
                'name_ar' => 'فانتوم',
                'brand_id' => 17,
                'category_id' => 9,
                'daily_price' => 5000,
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
