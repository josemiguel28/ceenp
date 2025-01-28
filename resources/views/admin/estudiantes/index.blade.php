<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <h1 class="font-semibold text-2xl">Estudiantes</h1>
        <p class="text-gray-500">Gestiona los estudiantes desde aqui.</p>


        <div class="mb-4 mt-8">
            <a href=" {{ route('estudiantes.create') }}">
                <x-primary-button>
                    {{ __('Nuevo Estudiante') }} +
                </x-primary-button>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <x-students-table :students="$students"/>

    </div>

</x-app-layout>
