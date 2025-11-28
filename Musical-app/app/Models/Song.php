<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [ //fillable fields for song
    'musical_id',
    'title',
    'duration',
    'composer',
    ];


    public function musical()
    { // Song belongs to a Musical
        return $this->belongsTo(Musical::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
