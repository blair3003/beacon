<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'venue_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'notes'
    ];

    /**
     * Get the course for the event.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the venue for the event.
     */
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    /**
     * Get the trainees that belong to the event. 
     */
    public function trainees()
    {
        return $this->belongsToMany(Trainee::class);
    }

    /**
     * Get the trainers that belong to the event. 
     */
    public function trainers()
    {
        return $this->belongsToMany(Trainer::class);
    }

    /**
     * Get the certificates for the event.
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }


}
