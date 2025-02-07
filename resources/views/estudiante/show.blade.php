@extends('layouts.user')

@section('title', 'Cursos - ' . $materia->nombre )

@section('content')

    <div class="max-w-6xl mx-auto">
        <!-- Encabezado -->
        <div class="bg-blue-900 text-white p-6 rounded-lg flex items-center justify-between relative h-36">
            <h1 class="text-3xl font-bold">{{ $materia->nombre }}</h1>
            <span class="text-green-300"></span>
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
                        <li class="flex items-center w-auto justify-between bg-gray-100 p-4 rounded-lg">

                            <form action="{{ route('maestro.destroy.task', $tarea->id) }}" method="post" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="flex items-center justify-center">
                                    <span class="ml-0 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                             viewBox="0 0 24 24"><path
                                                fill="none" stroke="#e11d48" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="m18 9l-.84 8.398c-.127 1.273-.19 1.909-.48 2.39a2.5 2.5 0 0 1-1.075.973C15.098 21 14.46 21 13.18 21h-2.36c-1.279 0-1.918 0-2.425-.24a2.5 2.5 0 0 1-1.076-.973c-.288-.48-.352-1.116-.48-2.389L6 9m7.5 6.5v-5m-3 5v-5m-6-4h4.615m0 0l.386-2.672c.112-.486.516-.828.98-.828h3.038c.464 0 .867.342.98.828l.386 2.672m-5.77 0h5.77m0 0H19.5"/></svg>
                                    </span>
                                </button>

                            </form>


                            <span class="text-gray-600 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"><g
                                        fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.5" color="#000000"><path
                                            d="M3.5 9.368c0-3.473 0-5.21 1.025-6.289S7.2 2 10.5 2h3c3.3 0 4.95 0 5.975 1.08C20.5 4.157 20.5 5.894 20.5 9.367v5.264c0 3.473 0 5.21-1.025 6.289S16.8 22 13.5 22h-3c-3.3 0-4.95 0-5.975-1.08C3.5 19.843 3.5 18.106 3.5 14.633z"/><path
                                            d="m8 2l.082.493c.2 1.197.3 1.796.72 2.152C9.22 5 9.827 5 11.041 5h1.917c1.213 0 1.82 0 2.24-.355c.42-.356.52-.955.719-2.152L16 2M8 16h4m-4-5h8"/></g></svg>
                            </span>

                            <div class="gap-8 flex justify-content-around max-w-80">
                                <a href="{{ route('estudiante.view.task', $tarea->id) }}" class="hover:underline truncate"
                                   title="{{ $tarea->titulo }}">{{ $tarea->titulo }}</a>
                                <a class="text-yellow-500 "
                                   href="{{ route('estudiante.view.task', $tarea->id) }}">Ver tarea</a>
                            </div>

                            <span
                                class="text-gray-500 ml-auto">{{ \Carbon\Carbon::parse($tarea->fecha_entrega)->translatedFormat('d F Y h:i A') }}</span>

                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Panel lateral -->
            <div class="space-y-6">
                <!-- Tareas Enviadas -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center border">
                    <h3 class="text-lg font-bold">Tareas enviadas</h3>
                    <p class="text-xl font-bold text-red-500">1 / 3</p>
                    <div class="w-full bg-gray-200 h-2 rounded-full mt-2">
                        <div class="bg-blue-500 h-2 rounded-full transition-all duration-300"
                             style="width: 1%;"></div>
                    </div>
                </div>
                <!-- Recursos del curso -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-4">Recursos de este curso</h3>
                    <div class="space-y-4">
                        <div class="bg-gray-300 rounded-lg overflow-hidden">
                            <img src="https://via.placeholder.com/300" alt="Video" class="w-full">
                            <div class="p-2 text-center">Grabación de clase 20 ene. 2024</div>
                        </div>
                        <div class="bg-gray-300 rounded-lg overflow-hidden">
                            <img src="https://via.placeholder.com/300" alt="Video" class="w-full">
                            <div class="p-2 text-center">Grabación de clase 20 ene. 2024</div>
                        </div>
                        <button class="w-full bg-gray-800 text-white py-2 rounded mt-4">Ver todos</button>
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
