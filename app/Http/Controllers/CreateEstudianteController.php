<?php

namespace App\Http\Controllers;

use App\Mail\SendUserCredentials;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CreateEstudianteController extends Controller
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
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);

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
            $estudiante->materiasStudents()->sync($request->materias);
        }

        Mail::to($estudiante->email)->send(new SendUserCredentials($estudiante, $password));

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado con éxito.');
    }

    public function edit($id)
    {
        $estudiante = User::findOrFail($id);
        $materias = Materia::all();
        $selectedMaterias = $estudiante->materiasStudents()
            ->select('materias.id', 'materias.nombre')  // obtiene las materias del estudiante
            ->get();

        return view('admin.estudiantes.create', [
            'estudiante' => $estudiante,
            'materias' => $materias,
            'materiasSeleccionadas' => $selectedMaterias,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'matricula' => 'required|string|unique:users,matricula,' . $id,
            'materias' => 'array|required'
        ]);

        $estudiante = User::findOrFail($id);

        $estudiante->update([
            'name' => $request->name,
            'email' => $request->email,
            'matricula' => $request->matricula,
            'status' => $request->status,
        ]);

        // Asignar materias al estudiante
        if ($request->has('materias')) {
            $estudiante->materiasStudents()->sync($request->materias);
        }

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado con éxito.');
    }

    public function destroy($id)
    {
        $estudiante = User::findOrFail($id); // Encuentra el estudiante por su ID
        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado con éxito.');
    }

}
