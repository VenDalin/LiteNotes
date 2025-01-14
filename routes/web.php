<?php

use PHPUnit\Event\Tracer\Tracer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashedNoteController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('/notes', NoteController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/trashed', [TrashedNoteController::class, 'index'])->name('trashed.index');
    Route::get('/trashed/{note}', [TrashedNoteController::class, 'show'])->withTrashed()->name('trashed.show');
    Route::put('/trashed/{note}', [TrashedNoteController::class, 'update'])->withTrashed()->name('trashed.update');
    Route::delete('/trashed/{note}', [TrashedNoteController::class, 'destroy'])->withTrashed()->name('trashed.destroy');
});






require __DIR__ . '/auth.php';
