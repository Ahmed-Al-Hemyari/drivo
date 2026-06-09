<?php

namespace Database\Seeders\Production;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $devUser = \App\Models\User::create([
                'name' => 'dev',
                'email' => 'dev@drivo.com',
                'password' => 'dev-123',
        ]);

        $devRole = \App\Models\Role::query()->where('name', 'super_admin')->first();
        $devUser->roles()->attach($devRole);
    }
}
