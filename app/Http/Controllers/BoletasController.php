<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoletasController extends Controller
{
    public function index()
    {
        $boletas = Boleta::with('user')->orderBy('created_at', 'desc')->paginate(10);


        return view('admin.boletas.index', compact('boletas'));
    }

    public function create()
    {
        $alumnos = User::where('role_id', 2)->get(); // Obtener solo estudiantes
        return view('admin.boletas.create', compact('alumnos'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'archivo_path' => 'required',
        ], [
            'user_id.exists' => 'El alumno seleccionado no existe.',
            'user_id.required' => 'El alumno es requerido.',
            'archivo_path.required' => 'El archivo es requerido.',
        ]);


        Boleta::create([
            'user_id' => $request->user_id,
            'archivo' => $request->archivo_path,
        ]);

        return redirect()->route('boletas.index')->with('success', 'Boleta subida correctamente.');
    }

    public function destroy(Boleta $boleta)
    {
        Storage::disk('public')->delete($boleta->archivo);
        $boleta->delete();

        return redirect()->route('boletas.index')->with('success', 'Boleta eliminada.');
    }
}
