<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:homeowner,tradie,admin',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^09\d{9}$/', // 09xxxxxxxxx
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role']
        ]);

        $user->profile()->create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'age' => $validated['age'],
            'address' => $validated['address'],
            'phone_number' => $validated['phone_number']
        ]);

        // Add OTP logic here
        //add a token
        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => new UserResource($user->load('profile'))
        ]);
    }


    //login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'token' => $request->user()->createToken('api')->plainTextToken,
                'user' => new UserResource($request->user()->load('profile'))
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }


    //logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
