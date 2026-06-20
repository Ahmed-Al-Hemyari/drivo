<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name_en', 'name_ar', 'daily_price', 'images', 'brand_id', 'category_id'])]
class Car extends Model
{
    use HasFactory, SoftDeletes;

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasManyThrough(Review::class, Booking::class, 'car_id', 'booking_id', 'id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function rate(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->reviews->isEmpty()) {
                    return null;
                }

                return round($this->reviews->avg('rate'), 1);
            }
        );
    }

    public function status(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->bookings->where('status', 'active')->isNotEmpty()) {
                    return 'Unavailable';
                }

                return 'Available';
            }
        );
    }

    protected function casts(): Array
    {
        return [
            'images' => 'array',
        ];
    }
}
