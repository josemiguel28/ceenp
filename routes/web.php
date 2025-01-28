<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/admin/estudiantes', [EstudianteController::class, 'index'])->name('estudiantes.index');
    Route::get('/admin/estudiantes/create', [EstudianteController::class, 'create'])->name('estudiantes.create');
    Route::post('/admin/estudiantes/store', [EstudianteController::class, 'store'])->name('estudiantes.store');
    Route::get('/admin/estudiantes/{id}/edit', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
    Route::put('/admin/estudiantes/{id}/update', [EstudianteController::class, 'update'])->name('estudiantes.update');
    Route::delete('/admin/estudiantes/{id}/destroy', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
