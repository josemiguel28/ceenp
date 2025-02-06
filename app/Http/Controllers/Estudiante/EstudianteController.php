<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $materias = auth()->user()->materiasStudents;
        return view('estudiante.index', compact('materias'));
    }
}
