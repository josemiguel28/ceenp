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
                <ul class="space-y-4">
                    @if($tareas->isEmpty())
                        <div class="bg-gray-50 border border-dashed border-gray-300 rounded-xl p-8 text-center">
                            <p class="text-sm text-gray-500">No tienes tareas publicadas en esta materia.</p>
                        </div>
                    @endif

                    @foreach($tareas as $tarea)
                        <li class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-gray-50 hover:bg-gray-100/90 border border-gray-200 rounded-xl p-4 transition-colors duration-150">
                            <!-- Icono y datos de la tarea -->
                            <div class="flex items-center gap-3.5 min-w-0 flex-1">
                                <!-- Icono de estado -->
                                <div class="flex-shrink-0">
                                    @if($tarea->entregada)
                                        <span class="flex items-center justify-center w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600" title="Tarea entregada">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                    @else
                                        <span class="flex items-center justify-center w-10 h-10 rounded-lg bg-amber-100 text-amber-600" title="Tarea pendiente">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>

                                <!-- Información de la tarea -->
                                <div class="min-w-0 flex-1">
                                    <a href="{{ route('estudiante.view.task', $tarea->id) }}"
                                       class="font-semibold text-gray-800 hover:text-blue-600 transition block truncate text-base"
                                       title="{{ $tarea->titulo }}">
                                        {{ $tarea->titulo }}
                                    </a>
                                    <div class="flex items-center gap-2 mt-1 text-xs text-gray-500">
                                        @if($tarea->entregada)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Entregada
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                                Pendiente
                                            </span>
                                        @endif
                                        <span class="text-gray-300">•</span>
                                        <span class="truncate">
                                            {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->translatedFormat('d F Y, h:i A') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón de acción -->
                            <div class="flex-shrink-0 sm:self-center">
                                <a href="{{ route('estudiante.view.task', $tarea->id) }}"
                                   class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg shadow-sm transition whitespace-nowrap">
                                    Ver tarea
                                </a>
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
