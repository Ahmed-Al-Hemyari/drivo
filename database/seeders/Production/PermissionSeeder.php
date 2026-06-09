<?php

namespace Database\Seeders\Production;

use App\Enums\PermissionTypes;
use App\Helpers\PermissionName;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Car;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin_role_id = 1;
        $admin_role_id = 2;
        $customer_role_id = 3;

        $super_admin_permissions = [
            [
                'role_id' => $super_admin_role_id,
                'name' => PermissionName::Verify(User::class),
                'label_en' => 'Users',
                'label_ar' => 'المستخدمون',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => true, 'ForceDeleteAny' => true,
            ],
            [
                'role_id' => $super_admin_role_id,
                'name' => PermissionName::Verify(Role::class),
                'label_en' => 'Roles',
                'label_ar' => 'المناصب',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => true, 'ForceDeleteAny' => true,
            ],
            [
                'role_id' => $super_admin_role_id,
                'name' => PermissionName::Verify(Permission::class),
                'label_en' => 'Permissions',
                'label_ar' => 'الصلاحيات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => true, 'ForceDeleteAny' => true,
            ],
            [
                'role_id' => $super_admin_role_id,
                'name' => PermissionName::Verify(Brand::class),
                'label_en' => 'Brands',
                'label_ar' => 'العلامات التجارية',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => true, 'ForceDeleteAny' => true,
            ],
            [
                'role_id' => $super_admin_role_id,
                'name' => PermissionName::Verify(Category::class),
                'label_en' => 'Categories',
                'label_ar' => 'الفئات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => true, 'ForceDeleteAny' => true,
            ],
            [
                'role_id' => $super_admin_role_id,
                'name' => PermissionName::Verify(Car::class),
                'label_en' => 'Cars',
                'label_ar' => 'السيارات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => true, 'ForceDeleteAny' => true,
            ],
            [
                'role_id' => $super_admin_role_id,
                'name' => PermissionName::Verify(Booking::class),
                'label_en' => 'Bookings',
                'label_ar' => 'الحجوزات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => true, 'ForceDeleteAny' => true,
            ],
            [
                'role_id' => $super_admin_role_id,
                'name' => PermissionName::Verify(Review::class),
                'label_en' => 'Reviews',
                'label_ar' => 'التقييمات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => true, 'ForceDeleteAny' => true,
            ],
        ];

        $admin_permissions = [
            [
                'role_id' => $admin_role_id,
                'name' => PermissionName::Verify(User::class),
                'label_en' => 'Users',
                'label_ar' => 'المستخدمون',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => false, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                'role_id' => $admin_role_id,
                'name' => PermissionName::Verify(Role::class),
                'label_en' => 'Roles',
                'label_ar' => 'المناصب',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => false, 'Replicate' => false, 'Update' => false, 'Delete' => false, 'DeleteAny' => false, 'Restore' => false, 'RestoreAny' => false, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                'role_id' => $admin_role_id,
                'name' => PermissionName::Verify(Permission::class),
                'label_en' => 'Permissions',
                'label_ar' => 'الصلاحيات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => false, 'Replicate' => false, 'Update' => false, 'Delete' => false, 'DeleteAny' => false, 'Restore' => false, 'RestoreAny' => false, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                'role_id' => $admin_role_id,
                'name' => PermissionName::Verify(Brand::class),
                'label_en' => 'Brands',
                'label_ar' => 'العلامات التجارية',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                'role_id' => $admin_role_id,
                'name' => PermissionName::Verify(Category::class),
                'label_en' => 'Categories',
                'label_ar' => 'الفئات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                'role_id' => $admin_role_id,
                'name' => PermissionName::Verify(Car::class),
                'label_en' => 'Cars',
                'label_ar' => 'السيارات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                'role_id' => $admin_role_id,
                'name' => PermissionName::Verify(Booking::class),
                'label_en' => 'Bookings',
                'label_ar' => 'الحجوزات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => true, 'Update' => true, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                // Admins moderate reviews (view and delete bad ones) but they shouldn't write or edit them
                'role_id' => $admin_role_id,
                'name' => PermissionName::Verify(Review::class),
                'label_en' => 'Reviews',
                'label_ar' => 'التقييمات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => false, 'Replicate' => false, 'Update' => false, 'Delete' => true, 'DeleteAny' => true, 'Restore' => true, 'RestoreAny' => true, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
        ];

        $customer_permissions = [
            [
                // Customers can view and update their own accounts (handled by policy logic), but cannot see lists or delete accounts
                'role_id' => $customer_role_id,
                'name' => PermissionName::Verify(User::class),
                'label_en' => 'Users',
                'label_ar' => 'المستخدمون',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => false, 'View' => true, 'Create' => false, 'Replicate' => false, 'Update' => true, 'Delete' => false, 'DeleteAny' => false, 'Restore' => false, 'RestoreAny' => false, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                'role_id' => $customer_role_id,
                'name' => PermissionName::Verify(Role::class),
                'label_en' => 'Roles',
                'label_ar' => 'المناصب',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => false, 'View' => false, 'Create' => false, 'Replicate' => false, 'Update' => false, 'Delete' => false, 'DeleteAny' => false, 'Restore' => false, 'RestoreAny' => false, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                'role_id' => $customer_role_id,
                'name' => PermissionName::Verify(Permission::class),
                'label_en' => 'Permissions',
                'label_ar' => 'الصلاحيات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => false, 'View' => false, 'Create' => false, 'Replicate' => false, 'Update' => false, 'Delete' => false, 'DeleteAny' => false, 'Restore' => false, 'RestoreAny' => false, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                'role_id' => $customer_role_id,
                'name' => PermissionName::Verify(Brand::class),
                'label_en' => 'Brands',
                'label_ar' => 'العلامات التجارية',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => false, 'Replicate' => false, 'Update' => false, 'Delete' => false, 'DeleteAny' => false, 'Restore' => false, 'RestoreAny' => false, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                'role_id' => $customer_role_id,
                'name' => PermissionName::Verify(Category::class),
                'label_en' => 'Categories',
                'label_ar' => 'الفئات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => false, 'Replicate' => false, 'Update' => false, 'Delete' => false, 'DeleteAny' => false, 'Restore' => false, 'RestoreAny' => false, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                'role_id' => $customer_role_id,
                'name' => PermissionName::Verify(Car::class),
                'label_en' => 'Cars',
                'label_ar' => 'السيارات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => false, 'Replicate' => false, 'Update' => false, 'Delete' => false, 'DeleteAny' => false, 'Restore' => false, 'RestoreAny' => false, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                // Customers view their own bookings, create bookings, and update them (e.g., to cancel or change dates)
                'role_id' => $customer_role_id,
                'name' => PermissionName::Verify(Booking::class),
                'label_en' => 'Bookings',
                'label_ar' => 'الحجوزات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => false, 'Update' => true, 'Delete' => false, 'DeleteAny' => false, 'Restore' => false, 'RestoreAny' => false, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
            [
                // Customers view all reviews, and can create/update their own reviews
                'role_id' => $customer_role_id,
                'name' => PermissionName::Verify(Review::class),
                'label_en' => 'Reviews',
                'label_ar' => 'التقييمات',
                'type' => PermissionTypes::CRUD->value,
                'ViewAny' => true, 'View' => true, 'Create' => true, 'Replicate' => false, 'Update' => true, 'Delete' => false, 'DeleteAny' => false, 'Restore' => false, 'RestoreAny' => false, 'ForceDelete' => false, 'ForceDeleteAny' => false,
            ],
        ];

        Permission::insert(array_merge($super_admin_permissions, $admin_permissions, $customer_permissions));
    }
}
