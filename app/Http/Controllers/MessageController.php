<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Job $job)
    {
        $messages = $job->messages()->with('sender', 'receiver')->get();
        return response()->json($messages);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request  $request, Job $job)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
            ]);
            $message = $job->messages()->create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $validated['receiver_id'],
            'content' => $validated['content'],
            ]);
            return response()->json($message, 201);
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
