<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    protected $fillable = [
        'homeowner_id',
        'title',
        'description',
        'budget',
        'location',
        // 'start_date',
        // 'end_date',
        // 'status',
    ];
    public function homeowner()
{
return $this->belongsTo(User::class, 'homeowner_id');
}
public function applications()
{
return $this->hasMany(JobApplication::class);
}
public function messages()
{
return $this->hasMany(Message::class);
}
public function payments()
{
return $this->hasMany(Payment::class);
}
public function ratings()
{
return $this->hasMany(Rating::class);
}
public function appointments()
{
return $this->hasMany(Appointment::class);
}

}
