@extends('layouts.user')

@section('title', 'Cursos - ' . $materia->nombre )

@section('content')

    <div class="max-w-6xl mx-auto">
        <!-- Encabezado -->
        <div class="bg-blue-900 text-white p-6 rounded-lg flex flex-col justify-items-start h-36">
            <!-- boton de volver
            <a href="{{ route('estudiante.dashboard.index' ) }}"
               class="inline-flex items-center px-4 py-2 mb-12 outline-black text-black font-semibold rounded-lg shadow-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300">
                ← Volver
            </a>
             -->
            <h1 class="text-3xl font-bold">{{ $materia->nombre }}</h1>

        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4"
                 role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Contenido -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <!-- Actividades Recientes -->
            <div class="bg-white p-6 rounded-lg shadow-md md:col-span-2">
                <h2 class="text-xl font-bold mb-4">Actividades Recientes</h2>
                <ul class="space-y-6">
                    @foreach($tareas as $tarea)
                        <li class="flex items-center justify-between bg-gray-100 p-4 rounded-lg w-full">
                            <!-- Icono de estado -->
                            @if($tarea->entregada)
                                <span class="mr-2">✅</span>
                            @else
                                <span class="mr-2">⏳</span>
                            @endif

                            <!-- Icono del documento -->
                            <span class="text-gray-600 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                                    <g fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                       stroke-width="1.5">
                                        <path
                                            d="M3.5 9.368c0-3.473 0-5.21 1.025-6.289S7.2 2 10.5 2h3c3.3 0 4.95 0 5.975 1.08C20.5 4.157 20.5 5.894 20.5 9.367v5.264c0 3.473 0 5.21-1.025 6.289S16.8 22 13.5 22h-3c-3.3 0-4.95 0-5.975-1.08C3.5 19.843 3.5 18.106 3.5 14.633z"/>
                                        <path
                                            d="m8 2l.082.493c.2 1.197.3 1.796.72 2.152C9.22 5 9.827 5 11.041 5h1.917c1.213 0 1.82 0 2.24-.355c.42-.356.52-.955.719-2.152L16 2M8 16h4m-4-5h8"/>
                                    </g>
                                </svg>
                            </span>

                            <!-- Contenedor del título -->
                            <div class="flex-1 flex items-center gap-4 max-w-80">
                                <a href="{{ route('estudiante.view.task', $tarea->id) }}"
                                   class="hover:underline truncate"
                                   title="{{ $tarea->titulo }}">{{ $tarea->titulo }}</a>
                            </div>

                            <div class="flex items-center gap-4">

                                <span class="text-gray-500">
                                    {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->translatedFormat('d F Y h:i A') }}
                                </span>

                                <a class="text-white px-4 py-2 bg-yellow-500 rounded-xl hover:underline"
                                   href="{{ route('estudiante.view.task', $tarea->id) }}">Ver tarea</a>
                            </div>
                        </li>

                    @endforeach
                </ul>
            </div>

            <!-- Panel lateral -->
            <div class="space-y-6">
                <!-- Tareas Enviadas -->
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-xl font-semibold text-gray-700 mb-3">Progreso de tareas</h2>

                    <div class="relative w-full bg-gray-200 rounded-full h-6 overflow-hidden">
                        <div class="bg-blue-500 h-full transition-all duration-500"
                             style="width: {{ $progreso }}%;">
                        </div>
                    </div>

                    <p class="text-sm text-gray-700 mt-2">
                        {{ $progreso }}% completado ({{ $tareas->where('entregada', true)->count() }}
                        de {{ $tareas->count() }} tareas entregadas)
                    </p>
                </div>
                <!-- Recursos del curso -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-4">Recursos de este curso</h3>

                    <div class="space-y-4">
                        @foreach($materiales as $material)
                            @php
                                $fileUrl = Storage::url($material->archivo);
                                $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
                            @endphp

                            <div class="bg-gray-100 rounded-lg p-4 flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    @if(in_array($fileExtension, ['mp4', 'mov', 'avi', 'webm']))
                                        <!-- Ícono de video -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                             viewBox="0 0 24 24">
                                            <path fill="#eab308"
                                                  d="m11.5 14.5l7-4.5l-7-4.5zM6 18V2h16v16zm2-2h12V4H8zm-6 6V6h2v14h14v2zM8 4v12z"/>
                                        </svg>
                                    @elseif(in_array($fileExtension, ['pdf']))
                                        <!-- Ícono de PDF -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                             viewBox="0 0 24 24">
                                            <g fill="none" stroke="#eab308" stroke-linecap="round"
                                               stroke-linejoin="round" stroke-width="1.5" color="#eab308">
                                                <path
                                                    d="M3.5 13v-.804c0-2.967 0-4.45.469-5.636c.754-1.905 2.348-3.407 4.37-4.118C9.595 2 11.168 2 14.318 2c1.798 0 2.698 0 3.416.253c1.155.406 2.066 1.264 2.497 2.353c.268.677.268 1.525.268 3.22V13"/>
                                                <path
                                                    d="M3.5 12a3.333 3.333 0 0 1 3.333-3.333c.666 0 1.451.116 2.098-.057a1.67 1.67 0 0 0 1.179-1.18c.173-.647.057-1.432.057-2.098A3.333 3.333 0 0 1 13.5 2m-10 20v-3m0 0v-1.8c0-.566 0-.848.176-1.024C3.85 16 4.134 16 4.7 16h.8a1.5 1.5 0 0 1 0 3zm17-3H19c-.943 0-1.414 0-1.707.293S17 17.057 17 18v1m0 3v-3m0 0h2.5M14 19a3 3 0 0 1-3 3c-.374 0-.56 0-.7-.08c-.333-.193-.3-.582-.3-.92v-4c0-.338-.033-.727.3-.92c.14-.08.326-.08.7-.08a3 3 0 0 1 3 3"/>
                                            </g>
                                        </svg>
                                    @elseif(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <!-- Ícono de Imagen -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                             viewBox="0 0 24 24">
                                            <path fill="#eab308"
                                                  d="M5 3h13a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3m0 1a2 2 0 0 0-2 2v11.59l4.29-4.3l2.5 2.5l5-5L20 16V6a2 2 0 0 0-2-2zm4.79 13.21l-2.5-2.5L3 19a2 2 0 0 0 2 2h13a2 2 0 0 0 2-2v-1.59l-5.21-5.2zM7.5 6A2.5 2.5 0 0 1 10 8.5A2.5 2.5 0 0 1 7.5 11A2.5 2.5 0 0 1 5 8.5A2.5 2.5 0 0 1 7.5 6m0 1A1.5 1.5 0 0 0 6 8.5A1.5 1.5 0 0 0 7.5 10A1.5 1.5 0 0 0 9 8.5A1.5 1.5 0 0 0 7.5 7"/>
                                        </svg>
                                    @else
                                        <!-- Ícono de archivo genérico -->
                                        <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor"
                                             stroke-width="2"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 2h9l6 6v14a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2z"></path>
                                        </svg>
                                    @endif

                                    <div>
                                        <div class="text-lg font-semibold">{{ $material->titulo }}</div>
                                        <div class="text-sm text-gray-600">{{ strtoupper($fileExtension) }}</div>
                                    </div>
                                </div>

                                <a href="{{ $fileUrl }}" target="_blank"
                                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                    Descargar
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="py-4">
                        {{ $materiales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete() {
                return confirm('¿Estás seguro de que deseas eliminar esta tarea?');
            }
        </script>
    @endpush
@endsection
