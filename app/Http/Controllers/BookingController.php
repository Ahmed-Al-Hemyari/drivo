<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function create(Car $car)
    {
        return Inertia::render('bookings/create-booking', [
            'car' => $car->load(['brand', 'category'])
        ]);
    }

    public function store(Request $request, Car $car)
    {
        $formFields = $request->validate([
            'start_date' => ['required', 'date', 'after:' . now()],
            'end_date'   => ['required', 'date', 'after:start_date'],
            'notes' => 'nullable|string',
        ]);

        $formFields['user_id'] = Auth::id();
        $formFields['car_id'] = $car->id;


        try {
            $booking = Booking::create($formFields);

            return redirect('/')
                ->with('success', __('Request submitted successfully!'));
        } catch (\Exception $e) {
            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }
}
