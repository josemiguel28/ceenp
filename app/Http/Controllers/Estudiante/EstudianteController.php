<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Biblioteca;
use App\Models\Entrega;
use App\Models\Materia;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    public function index()
    {
        $materias = auth()->user()->materiasStudents; // Obtiene las materias del estudiante

        //obtiene de la tabla boletas
        $boletas = auth()->user()->boletas;

        //recursos generales
        $recursos = Biblioteca::orderBy('created_at', 'desc')->paginate(10);

        return view('estudiante.index',
            compact(
                'materias',
                'boletas',
                            'recursos'
            ));
    }


    public function show($materia)
    {
        $materia = Materia::findOrFail($materia);
        $tareas = $materia->tareas;
        $materiales = $materia->materiales()->orderBy('created_at', 'desc')->paginate(10);

        // Contar tareas entregadas
        $tareasEntregadas = 0;

        $tareas->each(function ($tarea) use (&$tareasEntregadas) {
            if ($tarea->entregas->contains('user_id', Auth::id())) {
                $tarea->entregada = true;
                $tareasEntregadas++;
            } else {
                $tarea->entregada = false;
            }
        });

        // Calcular porcentaje de progreso
        $totalTareas = $tareas->count();
        $progreso = $totalTareas > 0 ? round(($tareasEntregadas / $totalTareas) * 100) : 0;

        return view('estudiante.show', compact('materia', 'tareas', 'progreso', 'materiales'));
    }


    public function viewTask($tarea)
    {
        $tarea = Tarea::find($tarea);

        // Si la tarea no existe, redirigir o mostrar un error
        if (!$tarea) {
            return redirect()->route('estudiante.dashboard.index')->with('error', 'Tarea no encontrada.');
        }

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
            'observacion' => 'nullable|string|max:500',
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

    public function updateEntrega(Request $request, Tarea $tarea)
    {
        $request->validate([
            'archivo_path' => 'required',
            'observacion' => 'nullable|string|max:500',
        ]);

        // Buscar la entrega existente
        $entrega = Entrega::where('tarea_id', $tarea->id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($entrega->calificacion) {
            return redirect()->route('estudiante.view.task', $tarea->id)
                ->with('error', 'No puedes actualizar una tarea que ya ha sido calificada.');
        }

        if ($entrega->archivo !== $request->archivo_path) {
            File::delete(public_path('storage/' . $entrega->archivo));
        }

        $entrega->archivo = $request->archivo_path;
        $entrega->comentario_alumno = $request->observacion;
        $entrega->save();

        return redirect()->route('estudiante.show', $tarea->materia)
            ->with('success', 'Tarea actualizada correctamente.');
    }
}
