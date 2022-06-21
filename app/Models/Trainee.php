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
     * Check trainee is trainer.
     */
    public function isTrainer() : bool
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
}
