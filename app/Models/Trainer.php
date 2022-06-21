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

    /**
     * Get the trainee associated with the trainer.
     */
    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
}
