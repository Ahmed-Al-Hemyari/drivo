<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name_en', 'name_ar', 'icon'])]
class Category extends Model
{
    use HasFactory, SoftDeletes;

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
