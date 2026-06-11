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
                'role_id' => 1,
        ]);
    }
}
