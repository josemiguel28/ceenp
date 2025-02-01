<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            {{ isset($materia) ? 'Editar Materia' : 'Registrar Materia' }}
        </h2>
        <form
            action="{{ isset($materia) ? route('materias.update', $materia->id) : route('materias.store') }}"
            method="POST"
            class="space-y-6"
            novalidate
        >
            @csrf
            @if(isset($materia))
                @method('PUT')
            @endif

            <!-- Campo: Nombre -->
            <div>
                <x-input-label for="name" :value="__('Nombre de la materia')"/>
                <x-text-input
                    type="text"
                    name="name"
                    id="name"
                    class="block w-full !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Ingresa el titulo de la materia"
                    :value="old('name', $materia->nombre ?? '')"
                    required
                />
                @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo: semestre -->
            <div>
                <x-input-label for="semestre" :value="__('Ingrese el semestre (1 - 2)')"/>
                <x-text-input
                    type="text"
                    name="semestre"
                    id="semestre"
                    class="block w-full !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Ingresa el semestre al que pertenece la materia"
                    :value="old('semestre', $materia->semestre ?? '')"
                    required
                />
                @error('semestre')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo: Descripcion -->
            <div>
                <x-input-label for="descripcion" :value="__('Ingrese una descripcion (opcional)')"/>

                <textarea
                    name="descripcion"
                    id="descripcion"
                    class="block w-full !py-3.5 border border-gray-300 rounded-lg min-h-14 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Ingresa una breve descripcion de la materia"
                    required
                >{{ old('descripcion', $materia->descripcion ?? '') }}</textarea>

                @error('descripcion')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botón: Guardar -->
            <div class="text-right">
                <x-primary-button
                    type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    {{ isset($materia) ? 'Guardar Cambios' : 'Crear materia' }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
