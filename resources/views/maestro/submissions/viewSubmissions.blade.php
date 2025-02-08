@extends('layouts.user')

@section('title', 'Calificar tarea' )

@section('content')
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Entregas de la Tarea: {{ $tarea->titulo }}</h1>

        <div class="space-y-6">
            @foreach($entregas as $entrega)
                <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">📌 Estudiante: {{ $entrega->estudiante->name }}</h3>

                    <div class="mt-2">
                        <p class="text-gray-600">📄 Archivo:
                            <a href="{{ Storage::url($entrega->archivo) }}" target="_blank"
                               class="text-blue-600 font-medium hover:underline">
                                Descargar
                            </a>
                        </p>
                        <p class="text-gray-600 mt-1">💬 Comentario: <span
                                class="italic">{{ $entrega->comentario_alumno}}</span></p>
                        <p class="text-gray-600 mt-1">📊 Calificación:
                            <span
                                class="{{ $entrega->calificacion ? 'font-semibold text-green-600' : 'text-red-500' }}">
                            {{ $entrega->calificacion ?? 'Sin calificar' }}
                        </span>
                        </p>
                    </div>

                    <!-- Formulario para calificar -->
                    <form action="{{ route('maestro.submission.score', $entrega) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <label for="calificacion" class="text-gray-700 font-medium">Calificación (0-10)</label>
                            <input type="number" name="calificacion" id="calificacion"
                                   class="w-20 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   step="0.1" min="0" max="10"
                                   value="{{ old('calificacion') ?? $entrega->calificacion }}"
                                   required>

                            <label for="observacion" class="text-gray-700 font-medium">Observacion (opcional)</label>

                            <textarea name="observacion" id="observacion"
                                      class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                      rows="2" placeholder="Escribe una observación">{{ old('observacion') }}{{ $entrega->comentario_maestro }}
                            </textarea>

                        </div>

                        <x-primary-button :class="'mt-4'">
                            ✅ Calificar
                        </x-primary-button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

@endsection
