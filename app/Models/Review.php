<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['rate', 'comment', 'booking_id'])]
class Review extends Model
{
    use HasFactory, SoftDeletes;

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
