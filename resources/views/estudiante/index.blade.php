<!-- resources/views/student/dashboard.blade.php -->
@extends('layouts.user')

@section('title', 'Dashboard Estudiante')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-blue-900 text-white p-6 rounded-lg mb-8 relative">
            <h1 class="text-2xl font-bold">¡Bienvenido a tu plataforma de aprendizaje!</h1>
            <p class="text-xl">Continúa avanzando hacia tus metas.</p>
            <!-- Circles
            <div class="absolute right-0 top-0">
                <div class="w-16 h-16 bg-yellow-500 rounded-full"></div>
                <div class="w-8 h-8 bg-yellow-500 rounded-full absolute right-10 top-10"></div>
                <div class="w-12 h-12 bg-yellow-500 rounded-full absolute right-20 top-20"></div>
                <div class="w-6 h-6 bg-yellow-500 rounded-full absolute right-30 top-30"></div>
            </div>
            -->
        </div>

        <!-- Greeting -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold">Buenas tardes, {{ auth()->user()->name }}</h2>
        </div>

        <!-- Courses -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Courses -->

            @foreach($materias as $materia)
                <div class="bg-cover bg-center rounded-lg overflow-hidden shadow-md"
                     style="background-image: url('{{ ('img/courses/') }}{{ random_int(1,5) . '_background.png' }}')">
                    <div class="p-4">
                        <h3 class="text-lg font-bold">{{$materia->nombre}} (75%)</h3>
                        <p class="text-sm">¡Tienes 2 tareas pendientes!</p>
                    </div>
                    <div class="flex justify-end p-4">
                        <button class="bg-blue-900 text-white px-4 py-2 rounded">→</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection




