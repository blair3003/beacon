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
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Check trainee is trainer.
     * 
     * @return bool
     */
    public function isTrainer()
    {
        return $this->trainer()->exists();

    }

    /**
     * Get the trainer associated with the trainee. 
     * 
     * @return \App\Models\Trainer
     */
    public function trainer()
    {
        return $this->hasOne(Trainer::class);
    }
}
