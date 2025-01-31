<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileHandlerController extends Controller
{
    public static function uploadResource(Request $request)
    {
        // Obtener el contexto desde el formulario de dropzone
        $context = $request->input('context', 'otros');

        $folder = 'otros'; // Valor por defecto

        if ($context === 'biblioteca.create') {
            $folder = 'recursos';
        } elseif ($context === 'estudiantes.tareas') {
            $folder = 'tareas';
        }

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store($folder, 'public');

            return response()->json([
                'path' => $path,
            ]);
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    }
}
