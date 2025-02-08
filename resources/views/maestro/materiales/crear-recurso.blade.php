@extends('layouts.user')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    @endpush
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">
            Crear Recurso para la Materia: {{ $materia->nombre }}
        </h1>

        <div>
            <form action="{{ route('upload.resources') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="dropzone"
                  id="dropzone"
            >
                @csrf
                <input type="hidden" name="context" value="maestro.create.material">
                <!-- Envía el contexto para guardar el PDF -->
                <div class="fallback">
                    <input name="file" type="file"/>
                </div>
            </form>

            @error('archivo_path')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

        </div>

        <form action="{{ route('maestro.materias.crear-recurso.store', $materia) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-4">
            @csrf

            <!-- Campo oculto para la ruta del archivo -->
            <input type="hidden" name="archivo_path" id="archivo_path">
            <!-- Título -->
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="titulo" id="titulo" required
                       class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción (opcional)</label>
                <textarea name="descripcion" id="descripcion" rows="3"
                          class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Botones -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Crear Recurso
                </button>
                <a href="{{ route('maestro.show', $materia) }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <!-- Dropzone.js Script -->


@endsection
