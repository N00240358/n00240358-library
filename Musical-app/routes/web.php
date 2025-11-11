<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicalController;
use App\Http\Controllers\SongController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('musicals.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Musical Routes

Route::get('/musicals', [MusicalController::class, 'index'])->name('musicals.index'); // using the Musical Controller to goto index.
Route::get('/musicals/create', [MusicalController::class, 'create'])->name('musicals.create'); // using the Musical Controller to goto create.
Route::get('/musicals/{musical}', [MusicalController::class, 'show'])->name('musicals.show'); // using the Musical Controller to goto show.
Route::post('/musicals', [MusicalController::class, 'store'])->name('musicals.store'); // using the Musical Controller to goto store.

Route::get('/musicals/{musical}/edit', [MusicalController::class, 'edit'])->name('musicals.edit'); // using the Musical Controller to goto edit.
Route::put('/musicals/{musical}', [MusicalController::class, 'update'])->name('musicals.update'); // using the Musical Controller to goto update.
Route::delete('/musicals/{musical}', [MusicalController::class, 'destroy'])->name('musicals.destroy'); // using the Musical Controller to goto destroy/delete.

// Nested song routes first
Route::get('musicals/{musical}/songs/create', [SongController::class, 'create'])->name('songs.create');
Route::post('musicals/{musical}/songs', [SongController::class, 'store'])->name('songs.store');

// Resource routes for songs (index, edit, update, destroy, show)
Route::resource('songs', SongController::class)->except(['create','store']);


require __DIR__.'/auth.php';