<?php

namespace App\Http\Controllers;

use App\Mail\SendUserCredentials;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CreateMaestroController extends Controller
{
    //

    public function index()
    {
        $MAESTRO_ROLE_ID = 3;
        $maestros = User::where('role_id', $MAESTRO_ROLE_ID)->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.maestros.index',
            [
                'teachers' => $maestros
            ]);
    }

    public function create()
    {
        $materias = Materia::all(); // Obtener todas las materias
        return view('admin.maestros.form',
            [
                'materias' => $materias
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'matricula' => 'required|string|unique:users,matricula',
            'materias' => 'array|required',
        ]);

        // Genera una contraseña aleatoria
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);

        DB::beginTransaction();

        try {
            // Crear el maestro
            $maestro = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'matricula' => $request->matricula,
                'role_id' => 3, // Rol asignado automáticamente
                'password' => bcrypt($password),
            ]);

            // Asignar materias al maestro
            if ($request->has('materias')) {
                $maestro->materiasTeachers()->sync($request->materias);
            }

            // Enviar credenciales por correo
            Mail::to($maestro->email)->send(new SendUserCredentials($maestro, $password));

            DB::commit();

            return redirect()->route('maestros.index')->with('success', 'Maestro creado y credenciales enviadas con éxito.');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Error al registrar maestro o enviar correo: ' . $e->getMessage(), [
                'exception' => $e,
                'email' => $request->email,
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'No se pudo crear el maestro porque falló el envío del correo de bienvenida. El registro no se guardó en la base de datos para evitar cuentas sin acceso. Motivo: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {

        $maestro = User::findOrFail($id);

        $materias = Materia::all();
        $selectedMaterias = $maestro->materiasTeachers()
            ->select('materias.id', 'materias.nombre')  // obtiene las materias del estudiante
            ->get();

        return view('admin.maestros.form',
            [
                'maestro' => $maestro,
                'materiasSeleccionadas' => $selectedMaterias,
                'materias' => $materias
            ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'matricula' => 'required|string|unique:users,matricula,' . $id,
            'materias' => 'array|required',
        ]);

        $maestro = User::findOrFail($id);

        $maestro->update([
            'name' => $request->name,
            'email' => $request->email,
            'matricula' => $request->matricula,
            'status' => $request->status,
        ]);

        // Asignar materias al estudiante
        if ($request->has('materias')) {
            $maestro->materiasTeachers()->sync($request->materias);
        }

        return redirect()->route('maestros.index')->with('success', 'Maestro actualizado con éxito.');
    }

    public function destroy($id)
    {
        $maestro = User::findOrFail($id);
        $maestro->delete();

        return redirect()->route('maestros.index')->with('success', 'Maestro eliminado con éxito.');
    }

}
