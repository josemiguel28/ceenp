<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use App\Models\Tarea;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $materias = auth()->user()->materiasStudents;

        return view('estudiante.index', compact('materias' ));
    }

    public function show($materia)
    {
        $materia = Materia::find($materia); // Buscar la materia por su id
        $tareas = $materia->tareas;
        //$material = $materia->material;

        return view('estudiante.show', compact('materia', 'tareas' /*'material'*/));
    }

    public function viewTask($tarea){
        $tarea = Tarea::find($tarea);
        $fechaActual = now();
        $tareaVencida = $fechaActual->greaterThan($tarea->fecha_entrega); // Si la fecha actual es mayor, la tarea está vencida.


        return view('estudiante.viewTask', compact('tarea', 'tareaVencida'));


    }
}
