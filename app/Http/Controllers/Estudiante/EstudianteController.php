<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Entrega;
use App\Models\Materia;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    public function index()
    {
        $materias = auth()->user()->materiasStudents;

        return view('estudiante.index', compact('materias' ));
    }

    public function show($materia)
    {
        $materia = Materia::find($materia);
        $tareas = $materia->tareas;

        // Para cada tarea, verificar si el estudiante ya la ha entregado
        $tareas->each(function ($tarea) {
            $tarea->entregada = $tarea->entregas->contains('user_id', Auth::id());
        });

        //$material = $materia->material;

        return view('estudiante.show', compact('materia', 'tareas' /*'material'*/));
    }

    public function viewTask($tarea){
        $tarea = Tarea::find($tarea);

        $fechaActual = now();
        $tareaVencida = $fechaActual->greaterThan($tarea->fecha_entrega); // Si la fecha actual es mayor, la tarea está vencida.

        // Buscar la entrega del estudiante para esta tarea
        $entrega = $tarea->entregas->where('user_id', Auth::id())->first();

        // Agregar datos a la tarea
        $tarea->entregada = $entrega ? true : false; // Si la tarea fue entregada
        $tarea->entrega = $entrega; // Guardar la entrega (archivo, comentario, calificación)
        $tarea->calificacion = $entrega ? $entrega->calificacion : null; // Si tiene calificación
        $tarea->comentario_maestro = $entrega ? $entrega->comentario_maestro : null; // Si tiene comentario del maestro
        $tarea->comentario_alumno = $entrega ? $entrega->comentario_alumno : null; // Si tiene comentario del maestro
        $tarea->archivo = $entrega ? $entrega->archivo : null; // Si tiene archivo entregado

        return view('estudiante.viewTask', compact('tarea', 'tareaVencida'));
    }

    public function procesarEntrega(Request $request, Tarea $tarea)
    {
        // Verificar que el estudiante está inscrito en la materia de la tarea
        if (!$tarea->materia->estudiantes->contains(Auth::id())) {
            abort(403, 'No tienes permiso para entregar esta tarea.');
        }


        // Validar los datos del formulario
        $request->validate([
            'archivo_path' => 'required', // Solo PDF, máximo 2MB
            'comentario' => 'nullable|string|max:500',
        ]);

        // Crear la entrega
        $entrega = new Entrega();
        $entrega->tarea_id = $tarea->id;
        $entrega->user_id = Auth::id();
        $entrega->archivo = $request->archivo_path;
        $entrega->comentario_alumno = $request->observacion;
        $entrega->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('estudiante.show', $tarea->materia)
            ->with('success', 'Tarea entregada correctamente.');
    }
}
