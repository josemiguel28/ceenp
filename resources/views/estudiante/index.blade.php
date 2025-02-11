@php use App\Models\Tarea;use Illuminate\Support\Facades\Auth; @endphp
    <!-- resources/views/student/dashboard.blade.php -->
@extends('layouts.user')

@section('title', 'Dashboard Estudiante')

@section('content')

    <div class="container mx-auto px-4 py-8">

        <div class="bg-blue-900 text-white p-5 rounded-lg mb-8 relative h-32 lg:p-8">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-semibold ">¡Bienvenido a tu plataforma de aprendizaje!</h1>
            <p class="text-sm sm:text-xl lg:text-xl ">Continúa avanzando hacia tus metas.</p>

            <div class="hidden absolute right-0 top-0 lg:block">
                <div class="w-16 h-16 bg-yellow-500 rounded-full"></div>
                <div class="w-8 h-8 bg-yellow-500 rounded-full absolute right-52 top-6"></div>
                <div class="w-12 h-12 bg-yellow-500 rounded-full absolute right-36 top-16"></div>
                <div class="w-6 h-6 bg-yellow-500 rounded-full absolute right-24 top-8"></div>
            </div>

        </div>

        <x-materias-user :materias="$materias"/>

        <h2 class="text-xl mb-4 text-gray-800 mt-8">Tus recursos</h2>
        <div class="p-1 flex flex-wrap items-center">

            @if($recursos->isEmpty())

                <div
                    class="bg-white overflow-hidden  ">
                    <div class="p-4">
                        <h3 class="text-sm text-gray-600">No tienes recursos publicados.</h3>
                    </div>
                </div>

            @endif

            @foreach($recursos as $recurso)

                @php
                    $colores = ['bg-orange-500', 'bg-blue-500', 'bg-green-500', 'bg-purple-500', 'bg-red-500'];
                    $colorAleatorio = $colores[array_rand($colores)];
                @endphp

                <div
                    class="flex-shrink-0 m-6 relative overflow-hidden {{ $colorAleatorio }} rounded-lg w-80 h-auto shadow-lg transition-transform transform mx-auto hover:scale-105 hover:shadow-xl">
                    <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                         style="transform: scale(1.5); opacity: 0.1;">
                        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)"
                              fill="white"/>
                        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                    </svg>
                    <div class="relative pt-10 px-10 flex items-center justify-center">
                        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                             style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                        </div>
                        <img class="relative w-40"
                             src="{{ asset('img/file_image2.png') }}"
                             alt="">
                    </div>
                    <div class="relative text-white px-6 pb-6 mt-6 w-full">
                        <div class="flex gap-3 pb-4">
                            <span class="block opacity-75 -mb-1 uppercase">{{$recurso->tipo}}</span>
                        </div>
                        <span
                            class="block rounded-full text-white-500 text-xs font-bold leading-none flex items-center">
                            {{$recurso->created_at->diffForHumans()}}
                        </span>
                        <div class="mb-6">
                            <span class="block font-semibold text-xl truncate"
                                  title="{{ $recurso->titulo }}">{{$recurso->titulo}}
                            </span>

                        </div>
                        <a href="{{ $recurso->tipo === 'pdf' ? asset('storage/' . $recurso->archivo) : $recurso->enlace }}"
                           target="_blank"
                           class="w-full text-center">
                            <x-primary-button
                                class="w-full bg-white text-orange-500 text-xs font-bold leading-none items-center hover:bg-gray-300 hover:text-orange-500">
                                Ver recurso
                            </x-primary-button>
                        </a>
                    </div>
                </div>

            @endforeach
        </div>

        <h2 class="text-xl mb-4 text-gray-800 mt-8">Tus boletas</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @if($boletas->isEmpty())

                <div
                    class="bg-white overflow-hidden  ">
                    <div class="p-4">
                        <h3 class="text-sm text-gray-600">No tienes boletas publicadas.</h3>
                    </div>
                </div>

            @endif

            <!-- Boletas -->
            @foreach($boletas as $boleta)
                <a href=" {{ asset('storage/' . $boleta->archivo) }} " target="_blank">
                    <div
                        class="bg-white shadow-md rounded-lg border border-gray-200 overflow-hidden transition-transform transform hover:scale-105 hover:shadow-xl hover:border-blue-500">
                        <div class="p-4">
                            <h3 class="text-sm">Publicada {{ $boleta->created_at->diffForHumans() }}</h3>
                            <p class="float-right text-md px-2 py-4 font-semibold">Ver boleta</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection




