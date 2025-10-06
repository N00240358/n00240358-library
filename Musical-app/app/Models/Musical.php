<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musical extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'premiere_date',
        'image',
        'duration',
        'director',
    ];
}
