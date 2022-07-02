<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'trainee_id'
    ];

    /**
     * Get the event for the certificate.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the trainee for the certificate.
     */
    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
}
