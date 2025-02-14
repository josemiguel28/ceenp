<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FileHandlerController extends Controller
{

    public function uploadResource(Request $request)
    {

        $context = $request->input('context', 'otros');
        $folder_context = match ($context) {
            'biblioteca.create' => 'recursos',
            'estudiante.create.task' => 'entregas',
            'maestro.create.task' => 'tareas',
            'boletas.create' => 'boletas',
            'maestro.create.material' => 'materiales',
            default => 'otros',
        };

        // Crea el receptor de archivos
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        // Verifica si el archivo se subió correctamente
        if (!$receiver->isUploaded()) {
            throw new UploadMissingFileException();
        }

        // Recibe el archivo y gestiona los fragmentos
        $save = $receiver->receive();

        if ($save->isFinished()) {
            $file = $save->getFile();
            $fileName = uniqid() . "." . $file->getClientOriginalExtension();
            $folder = $folder_context;

            Storage::disk('public')->put("{$folder}/{$fileName}", $file->getContent());

           // $path = $file->storeAs("public/{$folder}", $fileName);
            $url = "{$folder}/{$fileName}"; // URL pública


            return response()->json(['path' => $url]);
        }

        // Modo chunking, responde con progreso
        $handler = $save->handler();
        return response()->json(["done" => $handler->getPercentageDone(), 'status' => true]);
    }

}
