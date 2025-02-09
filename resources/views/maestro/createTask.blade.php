@extends('layouts.user')

@section('title', 'Crear Tarea')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Crear Nueva Tarea</h1>
        <p class="text-gray-600 mb-6">Materia: <span class="font-semibold text-blue-700">{{ $materia->nombre }}</span>
        </p>

        <form action="{{ route('maestro.store.task', $materia) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <x-input-label for="titulo" :value="__('Título')"/>
                <x-text-input
                    type="text"
                    name="titulo"
                    id="titulo"
                    class="block w-full !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Ingresa el título"
                    :value="old('titulo', $material->titulo ?? '')"
                    required
                />
                @error('titulo')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-4">
                <x-input-label for="descripcion" :value="__('Descripcion')"/>
                <textarea name="descripcion" id="descripcion"
                          class="w-full border rounded-lg border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                          rows="3"></textarea>
            </div>

            <div class="mb-4">
                <x-input-label for="fecha_entrega" :value="__('Fecha de Entrega')"/>
                <x-text-input
                    type="datetime-local"
                    name="fecha_entrega"
                    id="fecha_entrega"
                    class="block w-full !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    :value="old('fecha_entrega', $material->fecha_entrega ?? '')"
                    required
                />
                @error('fecha_entrega')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror

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
