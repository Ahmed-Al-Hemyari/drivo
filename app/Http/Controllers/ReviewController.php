<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ReviewController extends Controller
{
    public function create(Booking $booking)
    {
        return Inertia::render('bookings/rate', [
            'booking' => $booking
        ]);
    }

    public function store(Booking $booking, Request $request)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $formFields = $request->validate([
            'rate' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        $formFields['booking_id'] = $booking->id;

        Review::create($formFields);
        $booking->update(['rated' => true]);

        return redirect('/')->with('success', __('Thank you for rating'));
    }
}
