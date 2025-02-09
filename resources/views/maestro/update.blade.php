@extends('layouts.user')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Editar</h1>
        <p class="text-gray-600 mb-6">Tarea: <span class="font-semibold text-blue-700">{{ $tarea->titulo }}</span></p>

        <form action="{{ route('maestro.update.task', $tarea) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div class="mb-4">
                <x-input-label for="titulo" :value="__('Titulo de la tarea')"/>
                <x-text-input
                    type="text"
                    name="titulo"
                    id="titulo"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required
                    :value="$tarea->titulo"
                />
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <x-input-label for="titulo" :value="__('Agrega una descripcion de la tarea')"/>
                <textarea
                    name="descripcion"
                    id="descripcion"
                    class="border-gray-300 rounded-md py-4 shadow-sm w-full"
                    rows="3"
                >{{ $tarea->descripcion }}</textarea>
            </div>

            <!-- Fecha de Entrega -->
            <div class="mb-4">
                <x-input-label for="fecha_entrega" :value="__('Fecha de Entrega')"/>
                <x-text-input
                    type="datetime-local"
                    name="fecha_entrega"
                    id="fecha_entrega"
                    required
                    :value="old('fecha_entrega', \Carbon\Carbon::parse($tarea->fecha_entrega))"

                />
            </div>

            <!-- Archivo
            <div class="mb-4">

                <x-input-label for="archivo" :value="__('Archivo (opcional)')"/>
                <x-text-input
                    type="file"
                    name="archivo"
                    id="archivo"
                />

                <small class="text-gray-500">Formatos permitidos: PDF, DOC, DOCX (máximo 2MB).</small>

            </div>

            @if ($tarea->archivo)
                <p class="my-8">Archivo actual   <a class="underline" href="{{ Storage::url($tarea->archivo) }}" target="_blank">Descargar</a></p>

            @endif

            -->

            <!-- Botones -->
            <div class="flex justify-between">
                <a href="{{ route('maestro.show', $tarea->materia_id) }}"
                   class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-all">Cancelar</a>

                <x-primary-button>
                    Actualizar Tarea
                </x-primary-button>
            </div>
        </form>
    </div>

@endsection
