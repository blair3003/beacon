<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

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
     * Get a combined version of the dates for the event.
     */
    public function getFullDatesAttribute()
    {
        return $this->start_date->format('M j') . " - " . $this->end_date->format('M j Y');
    }

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
