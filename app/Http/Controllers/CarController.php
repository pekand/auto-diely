<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('parts')->orderBy('created_at', 'desc')->get();
        return Inertia::render('Cars', [
            'cars' => $cars
        ]);
    }

    public function edit($id)
    {
        $car = Car::with('parts')->findOrFail($id);

        return Inertia::render('Car', [
            'car' => $car
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:100',
            'is_registered' => 'nullable',
        ]);

        $data['is_registered'] = $request->boolean('is_registered');

        $car = Car::create($data);

        $car->load('parts');

        return Inertia::render('Car', [
            'car' => $car
        ]);
    }

    public function update(Request $request, $id)
    {
        $car = Car::with('parts')->findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:100',
            'is_registered' => 'nullable',
        ]);

        $data['is_registered'] = $request->boolean('is_registered');

        $car->update($data);
        $car->refresh();

        return Inertia::render('Car', [
            'car' => $car
        ]);
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Record deleted successfully.');
    }
}
