<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlphabetController;
use App\Http\Controllers\CorpsController;
use App\Http\Controllers\FormeController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\FruitLegumeController;
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

require __DIR__.'/auth.php';
Route::get('/alphabet', [AlphabetController::class, 'index'])->name('alphabet');
Route::get('/corps', [CorpsController::class, 'index'])->name('corps');


Route::get('/formes', [FormeController::class, 'index'])->name('formes');


Route::post('/toggle-theme', [ThemeController::class, 'toggle'])->name('theme.toggle');



Route::get('/fruitlegume', [FruitLegumeController::class, 'index'])->name('fruitlegume.index');
Route::get('/fruitlegume/exercice', [FruitLegumeController::class, 'exercice'])->name('fruitlegume.exercice');
Route::post('/fruitlegume/resultat', [FruitLegumeController::class, 'resultat'])->name('fruitlegume.resultat');
