<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'start_date',
    'end_date',
    'notes',
    'status',
    'rated',
    'user_id',
    'car_id'
])]
class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookingStatus()
    {
        return $this->belongsTo(BookingStatus::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function moneyTransactions()
    {
        return $this->hasMany(MoneyTransaction::class);
    }

    public function duration(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->car) {
                    return 0;
                }

                $days = $this->start_date->diffInDays($this->end_date);
                $chargeableDays = round(max(1, $days));

                return $chargeableDays;
            }
        );
    }

    public function totalAmount(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->car) {
                    return 0;
                }

                $days = $this->start_date->diffInDays($this->end_date);
                $chargeableDays = round(max(1, $days));

                return $this->car->daily_price * $chargeableDays;
            }
        );
    }

    public function totalPaid(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->moneyTransactions()->where('transaction_type', 0)->sum('amount');
            }
        );
    }

    public function totalRemaining(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->totalAmount - $this->totalPaid;
            }
        );
    }
}
