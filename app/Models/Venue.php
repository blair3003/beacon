<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function scopeFilter($query, array $filters) {

        if ($filters['q'] ?? false) {
            $query->where('name', 'like', '%' . request('q') . '%');
        }
    }

    /**
     * Get the events for the course.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
