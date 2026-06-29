<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'brand', 'category', 'price', 'rate']);

        $cars = Car::with(['brand', 'category'])
            ->filter($filters)
            ->paginate(4)
            ->withQueryString();

        $brands = Brand::orderBy('name_en', 'asc')->get(['id', 'name_en', 'name_ar']);
        $categories = Category::orderBy('name_en', 'asc')->get(['id', 'name_en', 'name_ar']);

        return inertia('cars/car-index', [
            'cars' => $cars,
            'brands' => $brands,
            'categories' => $categories,
            'filters' => $filters,
        ]);
    }

    public function show(Car $car)
    {
        $car->load(['brand', 'category', 'bookings', 'rates.user']);

        return Inertia::render('cars/car-show', [
            'car' => $car,
        ]);
    }
}
