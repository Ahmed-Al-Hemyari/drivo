<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('home', [
        'categories' => \App\Models\Category::all(),
        'brands' => \App\Models\Brand::all(),
    ]);
})->name('home');
Route::get('/about', function () {
    return Inertia::render('about');
})->name('about');
Route::get('/cars', [CarController::class, 'index'])->name('cars.webIndex');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.webShow');

// Language Switch
Route::post('/locale/{lang}', [LocaleController::class, 'switch'])->name('locale.switch');

Route::middleware('auth')->group(function () {

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/add/{car}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/add/{car}', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/cancel/{booking}', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::delete('/bookings/delete/{booking}', [BookingController::class, 'delete'])->name('bookings.delete');

    // Rate
    Route::get('bookings/{booking}/rate', [ReviewController::class, 'create'])->name('bookings.create');
    Route::post('bookings/{booking}/rate', [ReviewController::class, 'store'])->name('bookings.store');

    // Profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [UserController::class, 'update']);
    Route::get('/reset-password', [UserController::class, 'resetPasswordView']);
    Route::post('/update-password', [UserController::class, 'updatePassword']);
});

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::inertia('/', 'home')->name('home');
// });

require __DIR__.'/settings.php';
