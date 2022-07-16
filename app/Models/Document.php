<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'path',
      'documentable_type',
      'documentable_id'
    ];

    /**
     * Get the parent documentable model (event or trainee).
     */
    public function documentable()
    {
        return $this->morphTo();
    }
}
