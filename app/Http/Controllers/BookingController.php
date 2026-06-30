<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::with(['car', 'car.category', 'car.brand', 'bookingStatus'])->where('user_id', $user->id)->latest()->get();

        return Inertia::render('bookings/booking-index', [
            'bookings' => $bookings,
        ]);
    }

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

    public function cancel(Booking $booking){

        if(!in_array($booking->booking_status_id, ['1', '2'])){
            return back()->with('error', __('This booking cannot be cancelled'));
        }

        $booking->update(['booking_status_id' => '3']);
        return back()->with('success', __('Booking cancelled successfully!'));
    }

    public function delete(Booking $booking){
        $booking->delete();
        return back()->with('success', __('Booking deleted successfully!'));
    }
}
