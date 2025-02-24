<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Car::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //create store function
        $validated = $request->validate([
            'car_name' => 'required|string',
            'car_make' => 'required|string',
            'car_model' => 'required|string',
            'car_year' => 'required|integer',
            'car_price' => 'required|numeric',
            'car_country' => 'required|string',
        ]);

        $car = $request->user()->cars()->create($validated);

        return response()->json($car, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return response()->json($car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function carUpdate(Request $request, Car $car)
    {
        //update the car
        // $validated = $request->validate([
        //     'car_name' => 'required|string',
        //     'car_make' => 'required|string',
        //     'car_model' => 'required|string',
        //     'car_year' => 'required|integer',
        //     'car_price' => 'required|numeric',
        //     'car_country' => 'required|string',
        // ]);

        // $car = $request->user()->cars()->update($validated);

        // return response()->json($car);

        $car->update($request->all());

        return response()->json($car);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //delete the car with response
        $car->delete();
        return response()->json(['message' => 'Car deleted']);
    }
}
