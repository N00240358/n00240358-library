<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController; // Dont forget to import the controller

Route::get('/', function () {
    return view('welcome');
});

// the /plants route will call the index() method of PlantController
Route::get('/plants', [PlantController::class, 'index']);
