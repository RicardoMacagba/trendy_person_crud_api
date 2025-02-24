<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    /** @use HasFactory<\Database\Factories\JobApplicationFactory> */
    use HasFactory;


    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function tradie()
    {
        return $this->belongsTo(User::class, 'tradie_id');
    }
}
