<?php

namespace Database\Seeders\Development;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'super_admin', 'label_en' => 'System', 'label_ar' => 'النظام'],
            ['name' => 'admin', 'label_en' => 'Admin', 'label_ar' => 'مدير'],
            ['name' => 'customer', 'label_en' => 'Customer', 'label_ar' => 'عميل'],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }
    }
}
