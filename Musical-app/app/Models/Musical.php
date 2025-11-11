<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musical extends Model
{
    use HasFactory;

    protected $fillable = [ //what fields we can input data into for the database.
        'title',
        'description',
        'premiere_date',
        'image',
        'duration',
        'director',
        'video'
    ];

    // A Musical has many Songs - One-to-Many Relationship
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    // Musicals can have many Actors - Many-to-Many Relationship
    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }
}
