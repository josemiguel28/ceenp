@extends('layouts.user')

@section('title', $materia->nombre )

@section('content')

    <div class="max-w-6xl mx-auto">
        <!-- Encabezado -->
        <div class="bg-blue-900 text-white p-6 rounded-lg flex items-center justify-between relative h-auto lg:h-36">
            <h1 class="text-3xl font-bold">{{ $materia->nombre }}</h1>

        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4"
                 role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif


        <!-- Botones -->
        <div class="max-w-3xl mt-8 lg:mt-16 flex flex-wrap items-center justify-between gap-6">
            <a href="{{ route('maestro.dashboard.index') }}"
               class="inline-flex items-center px-4 py-2 mb-6 lg:mb-12 outline-black text-black font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300">
                ← Volver
            </a>

            <div>
                <a href="{{ route('maestro.create.task', $materia->id) }}">
                    <x-primary-button>
                        Crear tarea
                    </x-primary-button>
                </a>

                <a href="{{ route('maestro.materias.crear-recurso', $materia->id) }}">
                    <x-secondary-button>
                        Crear recurso
                    </x-secondary-button>
                </a>
            </div>

        </div>

        <!-- Contenido -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <!-- Actividades Recientes -->
            <div class="bg-white p-6 rounded-lg shadow-md md:col-span-2">
                <h2 class="text-xl font-bold mb-4">Actividades Recientes</h2>
                <ul class="space-y-6">
                    @foreach($tareas as $tarea)
                        <li class="flex flex-wrap items-center justify-between bg-gray-100 p-4 rounded-lg gap-4 md:flex-nowrap">

                            <form action="{{ route('maestro.destroy.task', $tarea->id) }}" method="post"
                                  onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="flex items-center justify-center text-red-500 hover:text-red-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="1.5"
                                              d="m18 9l-.84 8.398c-.127 1.273-.19 1.909-.48 2.39a2.5 2.5 0 0 1-1.075.973C15.098 21 14.46 21 13.18 21h-2.36c-1.279 0-1.918 0-2.425-.24a2.5 2.5 0 0 1-1.076-.973c-.288-.48-.352-1.116-.48-2.389L6 9m7.5 6.5v-5m-3 5v-5m-6-4h4.615m0 0l.386-2.672c.112-.486.516-.828.98-.828h3.038c.464 0 .867.342.98.828l.386 2.672m-5.77 0h5.77m0 0H19.5"/>
                                    </svg>
                                </button>
                            </form>

                            {{-- Ícono de tarea --}}
                            <span class="text-gray-600 hidden lg:block">
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

                            {{-- Información de la tarea --}}
                            <div class="flex flex-col md:flex-col gap-4 flex-grow">
                                <a href="{{ route('maestro.edit.task', $tarea->id) }}"
                                   class="font-semibold hover:underline truncate w-full md:w-auto"
                                   title="{{ $tarea->titulo }}">{{ $tarea->titulo }}</a>

                                <div class="flex gap-4">
                                    <a href="{{ route('maestro.edit.task', $tarea->id) }}"
                                       class="text-yellow-500 hover:text-yellow-600 transition">
                                        Editar
                                    </a>
                                    <a href="{{ route('maestro.view.submissions', $tarea->id) }}"
                                       class="text-secondary-default hover:text-blue-600 transition">
                                        Ver entregas
                                    </a>
                                </div>
                            </div>

                            {{-- Fecha de entrega --}}
                            <span class="text-gray-500 text-sm md:text-base whitespace-nowrap ">
                                {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->translatedFormat('d F Y h:i A') }}
                             </span>

                        </li>

                    @endforeach
                </ul>
            </div>

            <!-- Panel lateral -->
            <div class="space-y-6">
                <!-- Recursos del curso -->
                <x-recursos-sidebar-user :materiales="$materiales" :materia="$materia" />
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
