<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FileHandlerController extends Controller
{

    public function uploadResource(Request $request) {
        try {
            $request->validate([
                'file' => 'required|file',
                'dzchunkindex' => 'required|integer',
                'dztotalchunkcount' => 'required|integer',
                'dzuuid' => 'required|string',
            ]);

            $context = $request->input('context', 'otros');
            $folder = match ($context) {
                'biblioteca.create' => 'recursos',
                'estudiante.create.task' => 'entregas',
                'maestro.create.task' => 'tareas',
                'boletas.create' => 'boletas',
                'maestro.create.material' => 'materiales',
                default => 'otros',
            };

            $file = $request->file('file');
            $chunkIndex = $request->input('dzchunkindex');
            $totalChunks = $request->input('dztotalchunkcount');
            $fileName = $request->input('dzuuid') . "." . $file->getClientOriginalExtension();

            // Ruta base dentro
            $basePath = storage_path("app/public/{$folder}");

            if (!file_exists($basePath)) {
                mkdir($basePath, 0777, true);
            }

            // Ruta del fragmento
            $chunkPath = "{$basePath}/{$fileName}.part{$chunkIndex}";

            // Mover el fragmento al almacenamiento
            $file->move($basePath, "{$fileName}.part{$chunkIndex}");

            $finalFileName = null;

            // Si es el último fragmento, unirlos
            if ($chunkIndex == $totalChunks - 1) {
                $finalFileName = uniqid() . "." . $file->getClientOriginalExtension();
                $finalFilePath = "{$basePath}/{$finalFileName}";

                try {
                    $fp = fopen($finalFilePath, 'w');

                    for ($i = 0; $i < $totalChunks; $i++) {
                        $chunkPath = "{$basePath}/{$fileName}.part{$i}";
                        if (!file_exists($chunkPath)) {
                            throw new \Exception("Fragmento {$i} no encontrado.");
                        }

                        $chunk = fopen($chunkPath, 'r');
                        stream_copy_to_stream($chunk, $fp);
                        fclose($chunk);
                        unlink($chunkPath); // Borra el fragmento
                    }

                    fclose($fp);
                } catch (\Exception $e) {
                    // Limpiar archivos temporales en caso de error
                    for ($i = 0; $i < $totalChunks; $i++) {
                        $chunkPath = "{$basePath}/{$fileName}.part{$i}";
                        if (file_exists($chunkPath)) {
                            unlink($chunkPath);
                        }
                    }
                    throw $e;
                }
            }

            if ($finalFileName) {
                // Ruta pública accesible desde la web
                return response()->json(['path' => "{$folder}/{$finalFileName}"]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

}
