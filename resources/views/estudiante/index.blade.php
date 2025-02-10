@php use App\Models\Tarea; @endphp
    <!-- resources/views/student/dashboard.blade.php -->
@extends('layouts.user')

@section('title', 'Dashboard Estudiante')

@section('content')

    <div class="container mx-auto px-4 py-8">

        <div class="bg-blue-900 text-white p-4 rounded-lg mb-8 relative h-32 lg:p-8">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-semibold ">¡Bienvenido a tu plataforma de aprendizaje!</h1>
            <p class="text-sm sm:text-xl lg:text-xl ">Continúa avanzando hacia tus metas.</p>

            <div class="hidden absolute right-0 top-0 lg:block">
                <div class="w-16 h-16 bg-yellow-500 rounded-full"></div>
                <div class="w-8 h-8 bg-yellow-500 rounded-full absolute right-52 top-6"></div>
                <div class="w-12 h-12 bg-yellow-500 rounded-full absolute right-36 top-16"></div>
                <div class="w-6 h-6 bg-yellow-500 rounded-full absolute right-24 top-8"></div>
            </div>

        </div>

        <x-materias-user :materias="$materias" />
    </div>

@endsection




