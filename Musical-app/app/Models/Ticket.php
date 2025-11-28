<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [ //fillable fields for ticket
    'user_id',
    'musical_id',
    ];


    public function musical()
    { // Ticket belongs to a Musical
        return $this->belongsTo(Musical::class);
    }

    public function user()
    { // Ticket belongs to a User
        return $this->belongsTo(User::class);
    }
    
}
