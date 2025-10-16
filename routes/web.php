<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpedienteController;
use Illuminate\Support\Facades\Route;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Dashboard: redirige directamente a la lista de expedientes
Route::get('/dashboard', [ExpedienteController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de Expedientes (CRUD) protegidas
Route::middleware('auth')->group(function () {
    Route::get('/expedientes', [ExpedienteController::class, 'index'])->name('expedientes.index');
    Route::get('/expedientes/create', [ExpedienteController::class, 'create'])->name('expedientes.create');
    Route::post('/expedientes', [ExpedienteController::class, 'store'])->name('expedientes.store');
    Route::get('/expedientes/{expediente}/edit', [ExpedienteController::class, 'edit'])->name('expedientes.edit');
    Route::put('/expedientes/{expediente}', [ExpedienteController::class, 'update'])->name('expedientes.update');
    Route::delete('/expedientes/{expediente}', [ExpedienteController::class, 'destroy'])->name('expedientes.destroy');
});

// Nueva ruta para restaurar expedientes eliminados
    Route::put('/expedientes/{expediente}/restore', [ExpedienteController::class, 'restore'])
        ->name('expedientes.restore');
    

// Autenticación (login, register, etc.)
require __DIR__.'/auth.php';
