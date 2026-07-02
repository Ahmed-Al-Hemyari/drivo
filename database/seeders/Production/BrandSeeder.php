<?php

namespace Database\Seeders\Production;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name_en' => 'Toyota',
                'name_ar' => 'تويوتا',
                'logo' => 'uploads/img/brands/toyota.png',
                'url' => 'https://toyota.com'
            ],
            [
                'name_en' => 'Honda',
                'name_ar' => 'هوندا',
                'logo' => 'uploads/img/brands/honda.png',
                'url' => 'https://honda.com'
            ],
            [
                'name_en' => 'Ford',
                'name_ar' => 'فورد',
                'logo' => 'uploads/img/brands/ford.png',
                'url' => 'https://ford.com'
            ],
            [
                'name_en' => 'Chevrolet',
                'name_ar' => 'شيفروليه',
                'logo' => 'uploads/img/brands/chevrolet.png',
                'url' => 'https://chevrolet.com'
            ],
            [
                'name_en' => 'BMW',
                'name_ar' => 'بي إم دبليو',
                'logo' => 'uploads/img/brands/bmw.png',
                'url' => 'https://bmw.com'
            ],
            [
                'name_en' => 'Mercedes-Benz',
                'name_ar' => 'مرسيدس-بنز',
                'logo' => 'uploads/img/brands/mercedes-benz.png',
                'url' => 'https://mercedes-benz.com'
            ],
            [
                'name_en' => 'Audi',
                'name_ar' => 'أودي',
                'logo' => 'uploads/img/brands/audi.png',
                'url' => 'https://audi.com'
            ],
            [
                'name_en' => 'Lexus',
                'name_ar' => 'لكزس',
                'logo' => 'uploads/img/brands/lexus.png',
                'url' => 'https://lexus.com'
            ],
            [
                'name_en' => 'Acura',
                'name_ar' => 'أكيورا',
                'logo' => 'uploads/img/brands/acura.png',
                'url' => 'https://acura.com'
            ],
            [
                'name_en' => 'Infiniti',
                'name_ar' => 'إنفينيتي',
                'logo' => 'uploads/img/brands/infiniti.png',
                'url' => 'https://infiniti.com'
            ],
            [
                'name_en' => 'Porsche',
                'name_ar' => 'بورش',
                'logo' => 'uploads/img/brands/porsche.png',
                'url' => 'https://porsche.com'
            ],
            [
                'name_en' => 'Ferrari',
                'name_ar' => 'فيراري',
                'logo' => 'uploads/img/brands/ferrari.png',
                'url' => 'https://ferrari.com'
            ],
            [
                'name_en' => 'Lamborghini',
                'name_ar' => 'لامبورغيني',
                'logo' => 'uploads/img/brands/lamborghini.png',
                'url' => 'https://lamborghini.com'
            ],
            [
                'name_en' => 'Maserati',
                'name_ar' => 'مازيراتي',
                'logo' => 'uploads/img/brands/maserati.png',
                'url' => 'https://maserati.com'
            ],
            [
                'name_en' => 'McLaren',
                'name_ar' => 'ماكلارين',
                'logo' => 'uploads/img/brands/mclaren.png',
                'url' => 'https://mclaren.com'
            ],
            [
                'name_en' => 'Aston Martin',
                'name_ar' => 'أستون مارتن',
                'logo' => 'uploads/img/brands/aston-martin.png',
                'url' => 'https://astonmartin.com'
            ],
            [
                'name_en' => 'Bentley',
                'name_ar' => 'بنتلي',
                'logo' => 'uploads/img/brands/bentley.png',
                'url' => 'https://bentley.com'
            ],
            [
                'name_en' => 'Rolls-Royce',
                'name_ar' => 'رولز رويس',
                'logo' => 'uploads/img/brands/rolls-royce.png',
                'url' => 'https://rolls-royce.com'
            ],
            [
                'name_en' => 'Jaguar',
                'name_ar' => 'جاكوار',
                'logo' => 'uploads/img/brands/jaguar.png',
                'url' => 'https://jaguar.com'
            ],
            [
                'name_en' => 'Land Rover',
                'name_ar' => 'لاند روفر',
                'logo' => 'uploads/img/brands/land-rover.png',
                'url' => 'https://landrover.com'
            ],
            [
                'name_en' => 'Mini',
                'name_ar' => 'ميني',
                'logo' => 'uploads/img/brands/mini.png',
                'url' => 'https://mini.com'
            ],
            [
                'name_en' => 'Fiat',
                'name_ar' => 'فيات',
                'logo' => 'uploads/img/brands/fiat.png',
                'url' => 'https://fiat.com'
            ],
            [
                'name_en' => 'Alfa Romeo',
                'name_ar' => 'ألفا روميو',
                'logo' => 'uploads/img/brands/alfa-romeo.png',
                'url' => 'https://alfaromeo.com'
            ],
        ];

        Brand::insert($brands);
    }
}
