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
        ]);

        $systemRole = \App\Models\Role::query()->where('name', 'super_admin')->first();
        $systemUser->roles()->attach($systemRole);

        $adminUser = \App\Models\User::create([
                'name' => 'Admin',
                'email' => 'admin@drivo.com',
                'password' => '123456',
        ]);

        $adminRole = \App\Models\Role::query()->where('name', 'admin')->first();
        $adminUser->roles()->attach($adminRole);

        $customerUser = \App\Models\User::create([
                'name' => 'Customer1',
                'email' => 'customer1@drivo.com',
                'password' => '123456',
        ]);

        $customerRole = \App\Models\Role::query()->where('name', 'customer')->first();
        $customerUser->roles()->attach($customerRole);

        $customerUser2 = \App\Models\User::create([
                'name' => 'Customer2',
                'email' => 'customer2@drivo.com',
                'password' => '123456',
        ]);

        $customerRole = \App\Models\Role::query()->where('name', 'customer')->first();
        $customerUser2->roles()->attach($customerRole);

        $customerUser3 = \App\Models\User::create([
                'name' => 'Customer3',
                'email' => 'customer3@drivo.com',
                'password' => '123456',
        ]);

        $customerRole = \App\Models\Role::query()->where('name', 'customer')->first();
        $customerUser3->roles()->attach($customerRole);
    }
}
