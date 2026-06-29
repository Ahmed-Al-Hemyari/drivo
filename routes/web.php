<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'home')->name('home');
Route::inertia('/about', 'about')->name('about');
Route::get('/cars', [CarController::class, 'index'])->name('cars.webIndex');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.webShow');

// Language Switch
Route::post('/locale/{lang}', [LocaleController::class, 'switch'])->name('locale.switch');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
