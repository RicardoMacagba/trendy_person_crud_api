<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if user is homeowner or tradie based on payment type
        // For example, homeowner makes a payment
        $user = $request->user();
        if ($user->role == 'homeowner') {
            $payments = $user->payments()->with('job')->get();
        } else if ($user->role == 'tradie') {
            $payments = $user->payments()->with('job')->get();
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        //return response()->json($payments);

        //string message
        return response()->json(['message' => 'Payment successful']);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
