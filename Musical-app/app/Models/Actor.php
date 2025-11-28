<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [ //fillable fields for actor
        'name',
        'birthdate',
        'biography',
    ];

    // Actors can be in many Musicals - Many-to-Many Relationship
    public function musicals()
    {
        return $this->belongsToMany(Musical::class);
    }
}
