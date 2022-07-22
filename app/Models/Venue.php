<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'tel',
        'address_1',
        'address_2',
        'address_3',
        'city',
        'country',
        'zip',
        'notes'
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
