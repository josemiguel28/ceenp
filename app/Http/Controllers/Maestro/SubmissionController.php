<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Models\Entrega;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function verEntregas(Tarea $tarea)
    {
        // Verificar que el maestro es el creador de la tarea
        if ($tarea->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver las entregas de esta tarea.');
        }

        $entregas = $tarea->entregas;
        return view('maestro.submissions.viewSubmissions', compact('tarea', 'entregas'));
    }

    public function calificarEntrega(Request $request, Entrega $entrega)
    {
        // Verificar que el maestro es el creador de la tarea asociada
        if ($entrega->tarea->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para calificar esta entrega.');
        }

        // Validar la calificación
        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:10',
            'comentario' => 'nullable|string',
        ]);

        // Asignar la calificación
        $entrega->calificacion = $request->calificacion;
        $entrega->comentario_maestro = $request->observacion;
        $entrega->save();

        return redirect()->route('maestro.view.submissions', $entrega->tarea)
            ->with('success', 'Calificación asignada correctamente.');
    }
}
