<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (config('app.env') == 'production')
          $this->productionSeeders();
        else
          $this->devSeeders();
    }

    public function devSeeders() {
        $this->call([
            Development\UserSeeder::class,
            Development\RoleSeeder::class,
            Development\PermissionSeeder::class,
        ]);
    }

    public function productionSeeders() {
        $this->call([
            Production\UserSeeder::class,
            Production\RoleSeeder::class,
            Production\PermissionSeeder::class,
        ]);
    }
}
