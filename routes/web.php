<?php

use App\Http\Controllers\EjercicioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RutinaController;
use App\Http\Controllers\SesionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*Route::get('/rutinas', [RutinaController::class,"index"])->name("rutinas.index");;
    Route::put('/rutinas', [RutinaController::class,"update"])->name("rutinas.update");;
    Route::get('/rutinas/create', [RutinaController::class,"create"])->name("rutinas.create");;
    Route::post('/rutinas', [RutinaController::class,"store"])->name("rutinas.store");;*/
    Route::resource('sesiones', SesionController::class);

    Route::resource('rutinas', RutinaController::class);
    Route::resource('ejercicios', EjercicioController::class);

});

require __DIR__.'/auth.php';
