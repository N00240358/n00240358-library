<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'musical_id',
    ];


    public function musical()
    {
        return $this->belongsTo(Musical::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
