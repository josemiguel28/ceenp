<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        return view('estudiante.tareas.index');
    }
}
