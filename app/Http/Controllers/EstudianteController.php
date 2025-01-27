<?php

namespace App\Http\Controllers;

use App\Mail\SendStudentCredentials;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EstudianteController extends Controller
{
    public function index()
    {

        $STUDENT_ROLE_ID = 2;
        $students = User::where('role_id', $STUDENT_ROLE_ID)->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.estudiantes.index',
            [
                'students' => $students
            ]);
    }

    public function create()
    {
        $materias = Materia::all(); // Obtener todas las materias
        return view('admin.estudiantes.create', compact('materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'matricula' => 'required|string|unique:users,matricula',
            'materias' => 'array|required',
        ]);

        //genera una contraseña aleatoria
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 10 );

        // Crear el estudiante
        $estudiante = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'matricula' => $request->matricula,
            'role_id' => 2, // Rol asignado automáticamente
            'password' => bcrypt($password),
        ]);

        // Asignar materias al estudiante
        if ($request->has('materias')) {
            $estudiante->materias()->sync($request->materias);
        }

        Mail::to($estudiante->email)->send(new SendStudentCredentials($estudiante, $password));

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado con éxito.');
    }
}
