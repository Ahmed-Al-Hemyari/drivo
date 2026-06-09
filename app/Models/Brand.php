<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name_en', 'name_ar', 'logo', 'url'])]
class Brand extends Model
{
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
