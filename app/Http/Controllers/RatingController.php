<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Job $job)
    {
        // $ratings = $job->ratings()->with('user')->get();
        // return response()->json($ratings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Job $job)
    {
        $validated = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string',
        ]);
        $rating = $job->ratings()->create([
            'user_id' => $request->user()->id,
            'rating' => $validated['rating'],
            'review' => $validated['review'],
        ]);
        return response()->json($rating, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
