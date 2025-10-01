<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicalController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/musicals', [MusicalController::class, 'index'])->name('musicals.index');
Route::get('/musicals/create', [MusicalController::class, 'create'])->name('musicals.create');
Route::get('/musicals/{musical}', [MusicalController::class, 'show'])->name('musicals.show');
Route::post('/musicals', [MusicalController::class, 'store'])->name('musicals.store');

Route::get('/musicals/{musical}/edit', [MusicalController::class, 'edit'])->name('musicals.edit');
Route::put('/musicals/{musical}', [MusicalController::class, 'update'])->name('musicals.update');
Route::delete('/musicals/{musical}', [MusicalController::class, 'destroy'])->name('musicals.destroy');

require __DIR__.'/auth.php';
