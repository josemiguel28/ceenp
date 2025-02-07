@extends('layouts.user')

@section('title', 'Dashboard Maestro')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <!-- Greeting -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold">Buenas tardes, {{ auth()->user()->name }}</h2>
        </div>

        <h1 class="text-xl mb-8">Tus cursos</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- Courses -->
            @foreach($materias as $materia)
                <div class="bg-white shadow-md rounded-lg border border-transparent transition transform hover:-translate-y-2 hover:shadow-lg hover:border-blue-500 flex flex-col aos-init" data-aos="fade-right">
                    <a href="{{ route('maestro.show', $materia->id) }}" class="flex-grow">
                        <div>
                            <picture>
                                <source srcset="{{ asset('img/courses/1_background.png') }}" type="image/webp">
                                <source srcset="{{ asset('img/courses/1_background.png') }}" type="image/jpeg">
                                <img loading="lazy" class="rounded-t-lg w-full h-40 object-fit" src="{{ asset('img/courses/1_background.png') }}" alt="derechos humanos">
                            </picture>
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold">{{ $materia->nombre }}</h3>
                            <p class="text-gray-700">.</p>
                        </div>
                    </a>
                    <!-- Call to Action -->
                    <div class="mt-4 text-right">
                        <a href="{{ route('maestro.show', $materia->id) }}" class="inline-block bg-blue-500 text-white text-sm font-semibold py-3 px-6 rounded-full mb-6 mx-4 shadow hover:bg-blue-600 transition">
                            Ver materia
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
