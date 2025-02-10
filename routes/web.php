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

    // 🔹 RUTAS PARA ESTUDIANTES
    Route::prefix('estudiante')->name('estudiante.')->group(function () {
        Route::get('/dashboard', [EstudianteController::class, 'index'])->name('dashboard.index');
        Route::get('/materias/{materia}', [EstudianteController::class, 'show'])->name('show');
        Route::get('/tareas/{tarea}', [EstudianteController::class, 'viewTask'])->name('view.task');
        Route::post('/tareas/{tarea}/entregar', [EstudianteController::class, 'procesarEntrega'])->name('send.task');
        Route::put('/tareas/{tarea}/entregar', [EstudianteController::class, 'updateEntrega'])->name('update.task');
    });

    // 🔹 RUTAS PARA MAESTROS
    Route::prefix('maestro')->name('maestro.')->group(function () {
        Route::get('/dashboard', [MaestroController::class, 'index'])->name('dashboard.index');
        Route::get('/materias/{materia}', [MaestroController::class, 'show'])->name('show');

        // Tareas
        Route::prefix('/tareas')->name('tareas.')->group(function () {
            Route::get('/{tarea}/editar', [MaestroController::class, 'editarTarea'])->name('edit');
            Route::put('/{tarea}', [MaestroController::class, 'updateTask'])->name('update');
            Route::delete('/{tarea}', [MaestroController::class, 'destroyTask'])->name('destroy');
            Route::get('/{tarea}/entregas', [SubmissionController::class, 'verEntregas'])->name('view.submissions');
        });

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

    // 🔹 RUTAS DE PERFIL
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

});


require __DIR__ . '/auth.php';
