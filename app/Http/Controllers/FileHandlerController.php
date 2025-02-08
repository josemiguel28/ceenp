<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileHandlerController extends Controller
{
    public static function uploadResource(Request $request)
    {

        // Obtener el contexto desde el formulario de dropzone
        $context = $request->input('context', 'otros');

        $folder = match ($context) {
            'biblioteca.create' => 'recursos',
            'estudiante.create.task' => 'entregas',
            'maestro.create.task' => 'tareas',
            'boletas.create' => 'boletas',
            'maestro.create.material' => 'materiales',
            default => 'otros',
        };

        try {
            ini_set('upload_max_filesize', '1024M');
            ini_set('post_max_size', '1024M');
            ini_set('memory_limit', '256M'); // Opcional, aumenta el límite de memoria si es necesario

            $path = $request->file('file')->store($folder, 'public');

            return response()->json([
                'path' => $path,
                'file' => $request->all()
            ]);

        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
