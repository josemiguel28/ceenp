<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estudiantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href=" {{ route('estudiantes.create') }}">
                    <x-primary-button>
                        {{ __('Nuevo Estudiante') }} +
                    </x-primary-button>
                </a>
            </div>

            <x-students-table :students="$students"/>

        </div>

    </div>
    </div>

</x-app-layout>
