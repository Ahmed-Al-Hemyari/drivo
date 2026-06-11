<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'label_en', 'label_ar'])]
class Role extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
