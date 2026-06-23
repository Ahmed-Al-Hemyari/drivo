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

    public function unavailableDates(): Attribute
    {
        return Attribute::make(
            get: function () {
                $bookings = $this->bookings()->whereIn('status',['pending', 'confirmed', 'active'])->get(['start_date', 'end_date']);
                $dates = [];

                foreach ($bookings as $booking) {
                    $period = new \DatePeriod(
                        new \DateTime($booking->start_date),
                        new \DateInterval('P1D'),
                        (new \DateTime($booking->end_date))->modify('+1 day')
                    );

                    foreach ($period as $date) {
                        $dates[] = $date->format('Y-m-d');
                    }
                }

                return array_values(array_unique($dates));
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

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: function () {
                $locale = app()->getLocale();

                $brandName = $this->brand?->{"name_{$locale}"} ?? '';
                $carName = $this->{"name_{$locale}"} ?? '';

                return trim("{$brandName} {$carName}");
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
