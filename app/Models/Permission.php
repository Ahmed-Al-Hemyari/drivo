<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'label_en', 'label_ar', 'type', 'ViewAny', 'View', 'Create', 'Replicate', 'Update', 'Delete', 'DeleteAny', 'Restore', 'RestoreAny', 'ForceDelete', 'ForceDeleteAny'])]
class Permission extends Model
{
    use HasFactory, SoftDeletes;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public const ResourcesNames = [
        User::class,
        Role::class,
        Permission::class,
        Brand::class,
        Category::class,
        Car::class,
        BookingStatus::class,
        Booking::class,
        Review::class,
        MoneyTransaction::class,
        GeneralSetting::class
    ];
}
