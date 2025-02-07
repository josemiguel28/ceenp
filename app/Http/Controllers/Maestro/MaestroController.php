<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaestroController extends Controller
{
    public function index()
    {
        $maestro = Auth::user();
        $materias = $maestro->materiasTeachers;

        return view('maestro.index', compact('materias'));
    }

    public function show($materia)
    {
        $materia = Materia::find($materia); // Buscar la materia por su id
        $tareas = $materia->tareas;
        //$material = $materia->material;

        return view('maestro.show', compact('materia', 'tareas' /*'material'*/));
    }

    public function asignarTarea(Materia $materia)
    {
        // Verificar que el maestro está asignado a esta materia
        if (!$materia->maestros->contains(Auth::id())) {
            abort(403, 'No tienes permiso para crear tareas en esta materia.');
        }

        return view('maestro.createTask ', compact('materia'));
    }

    public function storeTarea(Request $request, Materia $materia)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_entrega' => 'required|date',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $tarea = new Tarea();
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->fecha_entrega = $request->fecha_entrega;
        $tarea->materia_id = $materia->id;
        $tarea->user_id = Auth::id(); // El maestro que asigna la tarea

        if ($request->hasFile('archivo')) {
            $tarea->archivo = $request->file('archivo')->store('tareas', 'public');
        }

        $tarea->save();

        return redirect()->route('maestro.show', $materia)
            ->with('success', 'Tarea asignada correctamente.');
    }

    public function editarTarea(Tarea $tarea)
    {
        // Verificar que el maestro es el creador de la tarea
        if ($tarea->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta tarea.');
        }

        return view('maestro.update', compact('tarea'));
    }

    public function updateTask(Request $request, Tarea $tarea)
    {
        // Verificar que el maestro es el creador de la tarea
        if ($tarea->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta tarea.');
        }

        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_entrega' => 'required|date',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // 2MB máximo
        ]);

        // Actualizar la tarea
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->fecha_entrega = $request->fecha_entrega;

        // Subir un nuevo archivo si se proporciona
        if ($request->hasFile('archivo')) {
            // Eliminar el archivo anterior si existe
            if ($tarea->archivo) {
                Storage::delete($tarea->archivo);
            }
            $tarea->archivo = $request->file('archivo')->store('tareas', 'public');
        }

        $tarea->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('maestro.show', $tarea->materia)
            ->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroyTask(Tarea $tarea)
    {
        // Verificar que el maestro es el creador de la tarea
        if ($tarea->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta tarea.');
        }

        // Eliminar el archivo si existe
        if ($tarea->archivo) {
            Storage::delete($tarea->archivo);
        }

        // Eliminar la tarea
        $tarea->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('maestro.show', $tarea->materia)
            ->with('success', 'Tarea eliminada correctamente.');
    }
}
