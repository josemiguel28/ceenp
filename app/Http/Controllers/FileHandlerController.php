<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FileHandlerController extends Controller
{

    public function uploadResource(Request $request) {
        try {
            $context = $request->input('context', 'otros');
            $folder = match ($context) {
                'biblioteca.create' => 'recursos',
                'estudiante.create.task' => 'entregas',
                'maestro.create.task' => 'tareas',
                'boletas.create' => 'boletas',
                'maestro.create.material' => 'materiales',
                default => 'otros',
            };

            // Datos de Dropzone
            $file = $request->file('file');
            $chunkIndex = $request->input('dzchunkindex');
            $totalChunks = $request->input('dztotalchunkcount');
            $fileName = $request->input('dzuuid') . "." . $file->getClientOriginalExtension();
            $chunkPath = storage_path("app/{$folder}/{$fileName}.part{$chunkIndex}");

            // Mover fragmento al almacenamiento
            $file->move(storage_path("app/{$folder}/"), "{$fileName}.part{$chunkIndex}");

            // Si es el último fragmento, unirlos
            if ($chunkIndex == $totalChunks - 1) {
                $finalFilePath = storage_path("app/{$folder}/{$fileName}");
                $fp = fopen($finalFilePath, 'w');

                for ($i = 0; $i < $totalChunks; $i++) {
                    $chunk = fopen(storage_path("app/{$folder}/{$fileName}.part{$i}"), 'r');
                    stream_copy_to_stream($chunk, $fp);
                    fclose($chunk);
                    unlink(storage_path("app/{$folder}/{$fileName}.part{$i}")); // Borra fragmento
                }

                fclose($fp);
            }

            return response()->json(['path' => "storage/{$folder}/{$fileName}"]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

}
