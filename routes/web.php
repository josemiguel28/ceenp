<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\BoletasController;
use App\Http\Controllers\CreateEstudianteController;
use App\Http\Controllers\Estudiante\EstudianteController;
use App\Http\Controllers\Estudiante\TareaController;
use App\Http\Controllers\FileHandlerController;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    // Ruta del dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Rutas de los estudiantes CRUD
    Route::resource('/admin/estudiantes', CreateEstudianteController::class)->names('estudiantes');
    // Rutas de los maestros CRUD
    Route::resource('/admin/maestros', MaestroController::class)->names('maestros');
    // Rutas de biblioteca
    Route::resource('/admin/biblioteca', BibliotecaController::class)->names('biblioteca');
    // Rutas de boletas
    Route::resource('/admin/boletas', BoletasController::class)->names('boletas')->except(['edit', 'update', 'show']);
    // Rutas de los recursos
    Route::post('/uploads', [FileHandlerController::class, 'uploadResource'])->name('upload.resources');
    // ruta de materias
    Route::resource('/admin/materias', MateriaController::class)->names('materias');
});


Route::middleware('auth')->group(function () {
    // Rutas de los estudiantes CRUD
    Route::resource('/estudiantes/dashboard', EstudianteController::class)->names('estudiante.dashboard');

    //ruta de tareas
   // Route::resource('/estudiantes/{materia}', TareaController::class)->names('materias.tareas');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
