<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users(Request $request)
    {
        $users = User::all();

        return response()->json($users);
    }

    public function jobs(Request $request)
    {
        $jobs = Job::with('homeowner', 'applications')->get();
        return response()->json($jobs);
    }
    public function resolveJob(Request $request, Job $job)
    {
        // Logic to resolve disputes, etc.
        $job->update(['status' => 'resolved']);
        return response()->json($job);
    }
}
