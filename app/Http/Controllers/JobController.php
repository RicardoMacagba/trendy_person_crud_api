<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->role == 'homeowner') {
            $jobs = $user->jobsPosted()->with('applications')->get();
        } else if ($user->role == 'tradie') {
            $jobs = Job::where('status', 'open')->get();
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($jobs);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->role != 'homeowner') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'budget' => 'required|numeric',
            ]);
            $job = $request->user()->jobsPosted()->create($validated);
            return response()->json($job, 201);
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return response()->json($job->load('applications', 'messages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //make an update to the job
        $job->update($request->all());

        return response()->json($job);

    }

    /**
     * Apply for a job.
     */
    public function apply(Job $job, Request $request)
    {
        $user = $request->user();
        if ($user->role != 'tradie') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $job->applications()->create([
            'tradie_id' => $user->id
        ]);
        return response()->json(['message' => 'Application submitted']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //create a delete function
        $job->delete();
        return response()->json(null, 204);

    }
}
