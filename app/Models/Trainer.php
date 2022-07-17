<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainee_id'
    ];

    public function scopeFilter($query, array $filters) {

        if ($filters['q'] ?? false) {
            $query->with('trainee')->whereHas('trainee', function($q) {
                $q->where('first_name', 'like', '%' . request('q') . '%')
                  ->orWhere('last_name', 'like', '%' . request('q') . '%');
            });
        }
    }

    /**
     * Get the trainee associated with the trainer.
     */
    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }

    /**
     * Get the events that belong to the trainer. 
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
