<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'job',
        'email',
        'mobile',
        'tel',
        'address_1',
        'address_2',
        'address_3',
        'city',
        'country',
        'zip'
    ];

    /**
     * Get the trainee's full name.
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Check trainee is trainer.
     */
    public function isTrainer()
    {
        return $this->trainer()->exists();

    }

    /**
     * Get the trainer associated with the trainee. 
     */
    public function trainer()
    {
        return $this->hasOne(Trainer::class);
    }

    /**
     * Get the events that belong to the trainee. 
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    /**
     * Get the certificates for the trainee.
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Get all of the documents for the trainee.
     */
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
