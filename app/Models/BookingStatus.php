<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name_ar', 'name_en', 'background_color', 'font_color'])]
class BookingStatus extends Model
{
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
