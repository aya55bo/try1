<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlphabetController;
use App\Http\Controllers\CorpsController;
use App\Http\Controllers\FormeController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\CouleurController;
use App\Http\Controllers\DessinController;
use App\Http\Controllers\AnimalController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Educational modules
    Route::get('/alphabet', [AlphabetController::class, 'index'])->name('alphabet');
    Route::get('/corps', [CorpsController::class, 'index'])->name('corps');
    Route::get('/formes', [FormeController::class, 'index'])->name('formes');
    Route::get('/animals', [AnimalController::class, 'index'])->name('animals');
    Route::get('/couleurs', [CouleurController::class, 'index'])->name('couleurs');
    Route::get('/transports', [TransportController::class, 'index'])->name('transports');

    // Drawing module
    Route::prefix('dessin')->group(function () {
        Route::get('/', [DessinController::class, 'index'])->name('dessin.index');
        Route::post('/sauvegarder', [DessinController::class, 'sauvegarder'])->name('dessin.sauvegarder');
        Route::post('/partager', [DessinController::class, 'partager'])->name('dessin.partager');
    });

    // Theme toggle
    Route::post('/toggle-theme', [ThemeController::class, 'toggle'])->name('theme.toggle');
});

require __DIR__.'/auth.php';