<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\BoletasController;
use App\Http\Controllers\CreateEstudianteController;
use App\Http\Controllers\Estudiante\EstudianteController;
use App\Http\Controllers\Maestro\MaestroController;
use App\Http\Controllers\Estudiante\TareaController;
use App\Http\Controllers\FileHandlerController;
use App\Http\Controllers\CreateMaestroController;
use App\Http\Controllers\Maestro\SubmissionController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfileController;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Ruta del dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Rutas de los estudiantes CRUD
    Route::resource('/admin/estudiantes', CreateEstudianteController::class)->names('estudiantes');
    // Rutas de los maestros CRUD
    Route::resource('/admin/maestros', CreateMaestroController::class)->names('maestros');
    // Rutas de biblioteca
    Route::resource('/admin/biblioteca', BibliotecaController::class)->names('biblioteca');
    // Rutas de boletas
    Route::resource('/admin/boletas', BoletasController::class)->names('boletas')->except(['edit', 'update', 'show']);
    // ruta de materias
    Route::resource('/admin/materias', MateriaController::class)->names('materias');
});

// Rutas de los recursos
Route::post('/uploads', [FileHandlerController::class, 'uploadResource'])->name('upload.resources');

Route::middleware('auth')->group(function () {
    // Rutas de los estudiantes CRUD
    Route::get('/estudiantes/dashboard', [EstudianteController::class, 'index'])->name('estudiante.dashboard.index');
    // ver detalles de una materia
    Route::get('estudiante/materias/{materia}', [EstudianteController::class, 'show'])->name('estudiante.show');
    // ver deatalles de una tarea
    Route::get('estudiante/tareas/{tarea}', [EstudianteController::class, 'viewTask'])->name('estudiante.view.task');
    // Ruta para procesar la entrega
    Route::post('/estudiante/tareas/{tarea}/entregar', [EstudianteController::class, 'procesarEntrega'])->name('estudiante.send.task');
    // Ruta para actualizar la entrega
    Route::put('/estudiante/tareas/{tarea}/entregar', [EstudianteController::class, 'updateEntrega'])->name('estudiante.update.task');


    // rutas de maestro
    Route::get('/maestro/dashboard', [MaestroController::class, 'index'])->name('maestro.dashboard.index');
    // Ver detalles de una materia (incluyendo tareas y material)
    Route::get('/maestro/materias/{materia}', [MaestroController::class, 'show'])->name('maestro.show');

    // Asignar una tarea a un material
    Route::get('/maestro/materias/{materia}/asignar-tarea', [MaestroController::class, 'asignarTarea'])->name('maestro.create.task');
    Route::post('/maestro/materias/{materia}/asignar-tarea', [MaestroController::class, 'storeTarea'])->name('maestro.store.task');

    // Editar tareas
    Route::get('/maestro/tareas/{tarea}/editar', [MaestroController::class, 'editarTarea'])->name('maestro.edit.task');
    Route::put('/maestro/tareas/{tarea}', [MaestroController::class, 'updateTask'])->name('maestro.update.task');

    //eliminar tarea
    Route::delete('/maestro/tareas/{tarea}', [MaestroController::class, 'destroyTask'])->name('maestro.destroy.task');

    // Ruta para ver las entregas de una tarea
    Route::get('/maestro/tareas/{tarea}/entregas', [SubmissionController::class, 'verEntregas'])
        ->name('maestro.view.submissions');

    // Ruta para calificar una entrega
    Route::post('/maestro/entregas/{entrega}/calificar', [SubmissionController::class, 'calificarEntrega'])
        ->name('maestro.submission.score');


    // Subir material de apoyo
    Route::post('/maestro/materias/{materia}/subir-material', [CreateMaestroController::class, 'subirMaterial'])->name('maestro.materias.subir-material');


    //ruta de tareas
    // Route::resource('/estudiantes/{materia}', TareaController::class)->names('materias.tareas');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
