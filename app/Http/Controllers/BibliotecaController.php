<?php

namespace App\Http\Controllers;

use App\Models\Biblioteca;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BibliotecaController extends Controller
{
    public function index()
    {
        $recursos = Biblioteca::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.biblioteca.index', compact('recursos'));
    }

    public function create()
    {
        return view('admin.biblioteca.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo' => 'required|in:pdf,enlace',
            'archivo_path' => 'nullable|string', // Ruta del archivo subido previamente
            'enlace' => 'nullable|url',
        ]);

        $recurso = new Biblioteca();
        $recurso->titulo = $request->titulo;
        $recurso->tipo = $request->tipo;

        // Asignar la ruta del archivo si el tipo es 'pdf'
        if ($request->tipo === 'pdf' && $request->filled('archivo_path')) {
            $recurso->archivo = $request->archivo_path;
        }
        if ($request->tipo === 'enlace') {
            $recurso->enlace = $request->enlace;
        }

        $recurso->save();

        return redirect()->route('biblioteca.index')->with('success', 'Recurso creado correctamente.');
    }

    public function destroy($recursoId)
    {
        $recurso = Biblioteca::findOrFail($recursoId);

        if ($recurso->tipo === 'pdf') {
            File::delete(public_path('storage/' . $recurso->archivo));
        }

        $recurso->delete();

        return redirect()->route('biblioteca.index')->with('success', 'Recurso eliminado correctamente.');
    }
}
