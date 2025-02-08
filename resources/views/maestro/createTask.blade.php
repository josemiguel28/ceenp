@extends('layouts.user')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Crear Nueva Tarea</h1>
        <p class="text-gray-600 mb-6">Materia: <span class="font-semibold text-blue-700">{{ $materia->nombre }}</span>
        </p>

        <form action="{{ route('maestro.store.task', $materia) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="titulo" class="block text-gray-700 font-semibold mb-1">Título</label>
                <input type="text" name="titulo" id="titulo"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       required>
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 font-semibold mb-1">Descripción</label>
                <textarea name="descripcion" id="descripcion"
                          class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                          rows="3"></textarea>
            </div>

            <div class="mb-4">
                <label for="fecha_entrega" class="block text-gray-700 font-semibold mb-1">Fecha de Entrega</label>
                <input type="datetime-local" name="fecha_entrega" id="fecha_entrega"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       required>
            </div>

            <!-- Archivo
            <div class="mb-4">
                <label for="archivo" class="block text-gray-700 font-semibold mb-1">Archivo (opcional)</label>
                <input type="file" name="archivo" id="archivo" class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <small class="text-gray-500">Formatos permitidos: PDF, DOC, DOCX (máximo 2MB).</small>
            </div>
            -->
            <!-- Botones -->
            <div class="flex justify-between">
                <a href="{{ route('maestro.show', $materia) }}"
                   class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-all">Cancelar</a>

                <x-primary-button>
                    Crear Tarea
                </x-primary-button>
            </div>
        </form>
    </div>

@endsection
