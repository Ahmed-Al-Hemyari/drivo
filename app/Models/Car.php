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

    protected $appends = [
        'rate',
        'unavailable_dates',
        'is_available',
    ];

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

    public function isAvailable(): Attribute
    {
        return Attribute::make(
            get: function () {
                $hasActiveBookings = $this->bookings()
                    ->whereHas('bookingStatus', function ($query) {
                        $query->where('name_en', 'active');
                    })->exists();

                if ($hasActiveBookings) {
                    return false;
                }

                return true;
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

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($q, $search) {
            $locale = app()->getLocale();

            $q->where(function ($q) use ($search, $locale) {
                // Search localized brand names
                $q->whereHas('brand', fn($q2) => $q2->where("name_ar", 'like', "%$search%"))
                ->orWhereHas('brand', fn($q2) => $q2->where("name_en", 'like', "%$search%"))
                // Or search localized category names
                ->orWhereHas('category', fn($q2) => $q2->where("name_en", 'like', "%$search%"))
                ->orWhereHas('category', fn($q2) => $q2->where("name_ar", 'like', "%$search%"))
                // Or search localized car names directly (replaces the broken 'full_name' accessor query)
                ->orWhere("name_en", 'like', "%$search%")
                ->orWhere("name_ar", 'like', "%$search%");
            });
        });

        $query->when($filters['brand'] ?? null, function ($q, $brand) {
            $locale = app()->getLocale();
            $q->whereHas('brand', fn($q2) => $q2->where("name_{$locale}", 'like', "%$brand%"));
        });

        $query->when($filters['category'] ?? null, function ($q, $category) {
            $locale = app()->getLocale();
            $q->whereHas('category', fn($q2) => $q2->where("name_{$locale}", 'like', "%$category%"));
        });

        $query->when($filters['price'] ?? null, function ($q, $price) {
            // Uniformly using 'daily_price' to fix the structural naming mismatch
            if (preg_match('/(\d+)-(\d+)/', $price, $m)) {
                $q->whereBetween('daily_price', [$m[1], $m[2]]);
            } elseif (str_ends_with($price, '+')) {
                $min = (int) rtrim($price, '+');
                $q->where('daily_price', '>=', $min);
            }
        });
    }

    protected function casts(): Array
    {
        return [
            'images' => 'array',
        ];
    }
}
