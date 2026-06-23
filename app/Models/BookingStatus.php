<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name_ar', 'name_en', 'background_color', 'font_color'])]
class BookingStatus extends Model
{
    use HasFactory, SoftDeletes;

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
