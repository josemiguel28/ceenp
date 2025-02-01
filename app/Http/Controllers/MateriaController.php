<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::orderBy('semestre', 'asc')->paginate(10);
        return view('admin.materias.index', compact('materias'));
    }

    public function create()
    {
        return view('admin.materias.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'semestre' => 'required|integer|min:1|in:1,2',
            'descripcion' => 'nullable|string',
        ]);

        Materia::create([
            'nombre' => $request->name,
            'semestre' => $request->semestre,
            'codigo' => null,
            'descripcion' => $request->descripcion ?? 'null',
        ]);

        return redirect()->route('materias.index')->with('success', 'Materia creada con éxito.');
    }

    public function edit($materiaId)
    {
        $materia = Materia::findOrFail($materiaId);
        return view('admin.materias.form', compact('materia'));
    }

    public function update(Request $request, $materiaId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'semestre' => 'required|integer|min:1|in:1,2',
            'descripcion' => 'nullable|string',
        ]);

        $materia = Materia::findOrFail($materiaId);
        $materia->nombre = $request->name;
        $materia->semestre = $request->semestre;
        $materia->descripcion = $request->descripcion ?? 'null';
        $materia->save();

        return redirect()->route('materias.index')->with('success', 'Materia actualizada con éxito.');
    }

    public function destroy($materiaId)
    {
        $materia = Materia::findOrFail($materiaId);
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada con éxito.');
    }
}
