<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\BoletasController;
use App\Http\Controllers\CreateEstudianteController;
use App\Http\Controllers\Estudiante\EstudianteController;
use App\Http\Controllers\Maestro\CreateMaterialController;
use App\Http\Controllers\Maestro\MaestroController;
use App\Http\Controllers\Estudiante\TareaController;
use App\Http\Controllers\FileHandlerController;
use App\Http\Controllers\CreateMaestroController;
use App\Http\Controllers\Maestro\SubmissionController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfileController;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Route;

// 🔹 RUTAS PARA ADMINISTRADORES
Route::middleware('role:1')->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('/admin/estudiantes', CreateEstudianteController::class)->names('estudiantes');
    Route::resource('/admin/maestros', CreateMaestroController::class)->names('maestros');
    Route::resource('/admin/biblioteca', BibliotecaController::class)->names('biblioteca');
    Route::resource('/admin/boletas', BoletasController::class)->names('boletas')->except(['edit', 'update', 'show']);
    Route::resource('/admin/materias', MateriaController::class)->names('materias');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

// 🔹 RUTAS PARA ESTUDIANTES
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::prefix('estudiante')->name('estudiante.')->group(function () {
        Route::get('/dashboard', [EstudianteController::class, 'index'])->name('dashboard.index');
        Route::get('/materias/{materia}', [EstudianteController::class, 'show'])->name('show');
        Route::get('/tareas/{tarea}', [EstudianteController::class, 'viewTask'])->name('view.task');
        Route::post('/tareas/{tarea}/entregar', [EstudianteController::class, 'procesarEntrega'])->name('send.task');
        Route::put('/tareas/{tarea}/entregar', [EstudianteController::class, 'updateEntrega'])->name('update.task');
    });
});

// 🔹 RUTAS PARA MAESTROS
Route::middleware(['auth', 'role:3'])->group(function () {
    Route::prefix('maestro')->name('maestro.')->group(function () {
        Route::get('/dashboard', [MaestroController::class, 'index'])->name('dashboard.index');
        Route::get('/materias/{materia}', [MaestroController::class, 'show'])->name('show');

        Route::get('/{tarea}/editar', [MaestroController::class, 'editarTarea'])->name('edit.task');
        Route::put('/{tarea}', [MaestroController::class, 'updateTask'])->name('update.task');
        Route::delete('/{tarea}', [MaestroController::class, 'destroyTask'])->name('destroy.task');
        Route::get('/{tarea}/entregas', [SubmissionController::class, 'verEntregas'])->name('view.submissions');

        // Asignación de tareas a materias
        Route::prefix('/materias/{materia}')->group(function () {
            Route::get('/asignar-tarea', [MaestroController::class, 'asignarTarea'])->name('create.task');
            Route::post('/asignar-tarea', [MaestroController::class, 'storeTarea'])->name('store.task');

            // Recursos
            Route::get('/crear-recurso', [CreateMaterialController::class, 'mostrarFormularioRecurso'])->name('materias.crear-recurso');
            Route::post('/crear-recurso', [CreateMaterialController::class, 'crearRecurso'])->name('materias.crear-recurso.store');
        });

        // Calificación de entregas
        Route::post('/entregas/{entrega}/calificar', [SubmissionController::class, 'calificarEntrega'])->name('submission.score');
    });
});

// 🔹 RUTAS DE PERFIL
Route::middleware('auth')->group(function () {
    // Ruta para subir recursos (PDF, imágenes, etc.)
    Route::post('/uploads', [FileHandlerController::class, 'uploadResource'])->name('upload.resources');
});


require __DIR__ . '/auth.php';
