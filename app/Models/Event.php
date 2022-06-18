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


}
