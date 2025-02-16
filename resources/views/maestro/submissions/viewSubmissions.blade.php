@extends('layouts.user')

@section('title', 'Calificar tarea' )

@section('content')
    <div class="max-w-5xl mx-auto p-6">

        <a href="{{ url()->previous() }}"
           class="inline-flex items-center px-4 py-2 mb-6 lg:mb-12 outline-black text-black font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300">
            ← Volver
        </a>

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Entregas de la Tarea: {{ $tarea->titulo }}</h1>

        <div class="space-y-6">

            @if($entregas->isEmpty())
                <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">No hay entregas</h3>
                    <p class="text-gray-600 text-sm">Veras las entregas de esta tarea cuando los estudiantes hayan
                        enviado su trabajo.</p>
                </div>
            @endif

            @foreach($entregas as $entrega)
                <livewire:maestro.check-submissions :entrega="$entrega" :key="$entrega->id"/>
            @endforeach


        </div>
    </div>

@endsection
