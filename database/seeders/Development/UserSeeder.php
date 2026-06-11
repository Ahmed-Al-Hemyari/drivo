<?php

namespace Database\Seeders\Development;

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
        $systemUser = \App\Models\User::create([
                'name' => 'System',
                'email' => 'system@drivo.com',
                'password' => '123456',
                'role_id' => 1,
        ]);

        $adminUser = \App\Models\User::create([
                'name' => 'Admin',
                'email' => 'admin@drivo.com',
                'password' => '123456',
                'role_id' => 2,
        ]);

        $customerUser = \App\Models\User::create([
                'name' => 'Customer1',
                'email' => 'customer1@drivo.com',
                'password' => '123456',
                'role_id' => 3,
        ]);

        $customerUser2 = \App\Models\User::create([
                'name' => 'Customer2',
                'email' => 'customer2@drivo.com',
                'password' => '123456',
                'role_id' => 3,
        ]);

        $customerUser3 = \App\Models\User::create([
                'name' => 'Customer3',
                'email' => 'customer3@drivo.com',
                'password' => '123456',
                'role_id' => 3,
        ]);
    }
}
