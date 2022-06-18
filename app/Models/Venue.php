<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the events for the course.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
