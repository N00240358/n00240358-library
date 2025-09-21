<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/suppliers', [SupplierController::class, 'index']);



