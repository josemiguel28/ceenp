@php use App\Models\Tarea; @endphp
<!-- resources/views/student/dashboard.blade.php -->
@extends('layouts.user')

@section('title', 'Dashboard Estudiante')

@section('content')

    <div class="container mx-auto px-4 py-8">

        <div class="bg-blue-900 text-white p-6 rounded-lg mb-8 relative h-32">
            <h1 class="text-2xl font-semibold">¡Bienvenido a tu plataforma de aprendizaje!</h1>
            <p class="text-xl">Continúa avanzando hacia tus metas.</p>

            <div class="absolute right-0 top-0">
                <div class="w-16 h-16 bg-yellow-500 rounded-full"></div>
                <div class="w-8 h-8 bg-yellow-500 rounded-full absolute right-52 top-6"></div>
                <div class="w-12 h-12 bg-yellow-500 rounded-full absolute right-36 top-16"></div>
                <div class="w-6 h-6 bg-yellow-500 rounded-full absolute right-24 top-8"></div>
            </div>

        </div>

        <div class="mb-8">
            @php
                $hora = now()->format('H');
                if ($hora < 12) {
                    $saludo = 'Buenos días';
                } elseif ($hora < 18) {
                    $saludo = 'Buenas tardes';
                } else {
                    $saludo = 'Buenas noches';
                }
            @endphp

            <h2 class="text-2xl font-semibold">{{ $saludo }}, {{ auth()->user()->name }}</h2>
        </div>

        <h1 class="text-xl mb-8">Tus cursos</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- Courses -->
            @foreach($materias as $materia)
                <div
                    class="bg-white shadow-md rounded-lg border border-transparent transition transform hover:-translate-y-2 hover:shadow-lg hover:border-blue-500 flex flex-col aos-init"
                    data-aos="fade-right">
                    <a href="/search-book?busqueda-libro=derechos+humanos" class="flex-grow">
                        <div>
                            <picture>
                                <source srcset="{{ asset('img/courses/1_background.png') }}" type="image/webp">
                                <source srcset="{{ asset('img/courses/1_background.png') }}" type="image/jpeg">
                                <img loading="lazy" class="rounded-t-lg w-full h-40 object-fit"
                                     src="{{ asset('img/courses/1_background.png') }}" alt="derechos humanos">
                            </picture>
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold">{{ $materia->nombre }}</h3>
                            <p class="text-gray-700">

                                @php
                                    $tareas = Tarea::where('materia_id', 1);
                                    $cantidad = $tareas->count();
                                @endphp

                                <span>{{ $cantidad }}</span>

                            </p>
                        </div>
                    </a>

                    <div class="mt-4 text-right">
                        <a href="{{ route('estudiante.show', $materia->id) }}"
                           class="inline-block bg-blue-500 text-white text-sm font-semibold py-3 px-6 rounded-full mb-6 mx-4 shadow hover:bg-blue-600 transition">
                            Ver materia
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection




