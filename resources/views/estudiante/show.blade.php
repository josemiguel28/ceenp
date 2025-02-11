@extends('layouts.user')

@section('title', $materia->nombre )

@section('content')

    <div class="max-w-6xl mx-auto">
        <!-- Encabezado -->
        <div class="bg-blue-900 text-white p-6 rounded-lg flex flex-col justify-items-start h-36">

            <h1 class="text-3xl font-bold">{{ $materia->nombre }}</h1>
            <p class="text-sm max-w-3xl mt-2 text-gray-300 hidden lg:block"> {{ $materia->descripcion }}</p>

        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4"
                 role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- boton de volver -->
        <a href="{{ route('estudiante.dashboard.index' ) }}"
           class="inline-flex items-center px-4 py-2 mb-2 mt-4 outline-black text-black font-semibold rounded-lg shadow-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300">
            ← Volver
        </a>

        <!-- Contenido -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <!-- Actividades Recientes -->
            <div class="bg-white p-6 rounded-lg shadow-md md:col-span-2">

                <div class="bg-white shadow-md rounded-lg mb-12 p-4 md:hidden">
                    <h2 class="text-xl font-semibold text-gray-700 mb-3">Progreso de tareas</h2>

                    <div class="relative w-full bg-gray-200 rounded-full h-6 overflow-hidden">
                        <div class="bg-secondary-default h-full transition-all duration-500"
                             style="width: {{ $progreso }}%;">
                        </div>
                    </div>

                    <p class="text-sm text-gray-700 mt-2">
                        {{ $progreso }}% completado ({{ $tareas->where('entregada', true)->count() }}
                        de {{ $tareas->count() }} tareas entregadas)
                    </p>
                </div>

                <h2 class="text-xl font-semibold mb-4 text-gray-700">Actividades Recientes</h2>
                <ul class="space-y-6">
                    @if($tareas->isEmpty())
                        <div
                            class="bg-white rounded-lg overflow-hidden">
                            <div class="p-4">
                                <h3 class="text-sm">No tienes tareas publicadas</h3>
                            </div>
                        </div>
                    @endif

                    @foreach($tareas as $tarea)
                        <li class="flex flex-wrap items-center justify-between bg-gray-100 p-4 rounded-lg gap-4 md:flex-nowrap">
                            <!-- Icono de estado -->
                            @if($tarea->entregada)
                                <span class="mr-2">✅</span>
                            @else
                                <span class="mr-2">⏳</span>
                            @endif

                            <!-- Icono del documento -->
                            <span class="text-gray-600 hidden md:block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                       stroke-width="1.5">
                                        <path
                                            d="M3.5 9.368c0-3.473 0-5.21 1.025-6.289S7.2 2 10.5 2h3c3.3 0 4.95 0 5.975 1.08C20.5 4.157 20.5 5.894 20.5 9.367v5.264c0 3.473 0 5.21-1.025 6.289S16.8 22 13.5 22h-3c-3.3 0-4.95 0-5.975-1.08C3.5 19.843 3.5 18.106 3.5 14.633z"/>
                                        <path
                                            d="m8 2l.082.493c.2 1.197.3 1.796.72 2.152C9.22 5 9.827 5 11.041 5h1.917c1.213 0 1.82 0 2.24-.355c.42-.356.52-.955.719-2.152L16 2M8 16h4m-4-5h8"/>
                                    </g>
                                </svg>
                             </span>

                            <!-- Información de la tarea -->
                            <div class="flex flex-col md:flex-row md:items-center gap-4 flex-grow">
                                <a href="{{ route('estudiante.view.task', $tarea->id) }}"
                                   class="font-semibold hover:underline truncate w-full md:w-auto text-regular"
                                   title="{{ $tarea->titulo }}">{{ $tarea->titulo }}</a>
                            </div>

                            <!-- Fecha de entrega y botón -->
                            <div class="flex items-center gap-4 flex-col w-full lg:w-auto lg:flex-row">
                                <span class="text-gray-500 text-sm md:text-base whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->translatedFormat('d F Y h:i A') }}
                                </span>
                                <a class="text-white px-4 py-2 bg-yellow-500 rounded-xl hover:underline w-full text-center"
                                   href="{{ route('estudiante.view.task', $tarea->id) }}">Ver tarea</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Panel lateral -->
            <div class="space-y-6">
                <!-- Tareas Enviadas -->
                <div class="bg-white shadow-md rounded-lg p-4 hidden md:block">
                    <h2 class="text-xl font-semibold text-gray-700 mb-3">Progreso de tareas</h2>

                    <div class="relative w-full bg-gray-200 rounded-full h-6 overflow-hidden">
                        <div class="bg-secondary-default h-full transition-all duration-500"
                             style="width: {{ $progreso }}%;">
                        </div>
                    </div>

                    <p class="text-sm text-gray-700 mt-2">
                        {{ $progreso }}% completado ({{ $tareas->where('entregada', true)->count() }}
                        de {{ $tareas->count() }} tareas entregadas)
                    </p>
                </div>
                <!-- Recursos del curso -->
                <x-recursos-sidebar-user :materiales="$materiales"/>
            </div>
        </div>
    </div>
@endsection
