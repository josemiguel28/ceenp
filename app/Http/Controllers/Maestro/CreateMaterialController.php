<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateMaterialController extends Controller
{
    public function mostrarFormularioRecurso(Materia $materia)
    {
        // Verificar que el maestro está asignado a esta materia
        if (!$materia->maestros->contains(Auth::id())) {
            abort(403, 'No tienes permiso para crear recursos en esta materia.');
        }

        return view('maestro.materiales.crear-recurso', compact('materia'));
    }

    public function crearRecurso(Request $request, Materia $materia)
    {
        // Verificar que el maestro está asignado a esta materia
        if (!$materia->maestros->contains(Auth::id())) {
            abort(403, 'No tienes permiso para crear recursos en esta materia.');
        }

        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo_path' => 'required',
        ]);

        // Crear el recurso
        $material = new Material();
        $material->titulo = $request->titulo;
        $material->descripcion = $request->descripcion;
        $material->materia_id = $materia->id;
        $material->user_id = Auth::id(); // El maestro que crea el recurso
        $material->archivo = $request->archivo_path;

        $material->save();

        return redirect()->route('maestro.show', $materia)
            ->with('success', 'Recurso creado correctamente.');
    }

    public function eliminarRecurso(Material $material)
    {
        $material = Material::findOrFail($material->id);

        // Eliminar el archivo del almacenamiento
        if ($material->archivo) {
            $path = storage_path("app/public/{$material->archivo}");
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $material->delete();

        return redirect()->route('maestro.show', $material->materia)
            ->with('success', 'Recurso eliminado correctamente.');
    }
}
