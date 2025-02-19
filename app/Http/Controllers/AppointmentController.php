<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Job $job)
    {
        $validated = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'scheduled_time' => 'required|date',
            // 'location' => 'required|string',
        ]);

        $job = Job::find($validated['job_id']);
        $appointment = $job->appointments()->create([
            'tradie_id' => $job->applications()->where('status', 'accepted')->first()->tradie_id,
            'homeowner_id' => $job->homeowner_id,
            'scheduled_time' => $validated['scheduled_time'],
            'status' => 'scheduled',
        ]);
        return response()->json($appointment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
