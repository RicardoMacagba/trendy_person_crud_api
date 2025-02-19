<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all()->load('profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //make function to store profile
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'address' => 'required|string',
            'phone_number' => 'required|regex:/^09\d{9}$/',
            'company_name' => 'required|string',
            'trade_type' => 'required_if:role,tradie|string',
            'hourly_rate' => 'required_if:role,tradie|numeric',

        ]);

        $profile = Profile::create($validated);

        return new UserResource($profile->load('profile'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user->load('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'age' => 'sometimes|integer',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|regex:/^09\d{9}$/',
            'trade_type' => 'nullable|required_if:role,tradie|string',
            'hourly_rate' => 'nullable|required_if:role,tradie|numeric',
            'company_name' => 'nullable|string'
        ]);

        $user->profile()->update($validated);

        return new UserResource($user->fresh()->load('profile'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();

        return response()->json(null, 204);
    }
}
