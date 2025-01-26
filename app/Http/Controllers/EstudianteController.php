<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {

        $estudiantes = User::where('role_id', 2)->get();

        return view('admin.estudiantes.index',
            [
                'estudiantes' => $estudiantes
            ]);
    }
}
