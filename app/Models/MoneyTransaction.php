<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['transaction_date', 'amount', 'transaction_type', 'atm', 'notes', 'booking_id'])]
class MoneyTransaction extends Model
{
    use HasFactory, SoftDeletes;

    public const TRANSACTION_TYPES = [
        0 => 'إيراد',
        1 => 'صرف',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
