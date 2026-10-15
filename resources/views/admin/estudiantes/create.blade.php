<x-app-layout>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            {{ isset($estudiante) ? 'Editar Estudiante' : 'Registrar Estudiante' }}
        </h2>

        @if(session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-md text-red-700">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-red-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h3 class="font-semibold text-sm text-red-800">Error al procesar la solicitud</h3>
                        <p class="text-sm mt-1 text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form
            action="{{ isset($estudiante) ? route('estudiantes.update', $estudiante->id) : route('estudiantes.store') }}"
            method="POST"
            class="space-y-6"
            novalidate
        >
            @csrf
            @if(isset($estudiante))
                @method('PUT')
            @endif

            <!-- Campo: Nombre -->
            <div>
                <x-input-label for="name" :value="__('Nombre del estudiante')"/>
                <x-text-input
                    type="text"
                    name="name"
                    id="name"
                    class="block w-full !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Ingresa el nombre completo"
                    :value="old('name', $estudiante->name ?? '')"
                    required
                />
                @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo: Correo -->
            <div>
                <x-input-label for="email" :value="__('Correo del estudiante')"/>
                <x-text-input
                    type="email"
                    name="email"
                    id="email"
                    class="block w-full !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="ejemplo@correo.com"
                    :value="old('email', $estudiante->email ?? '')"
                    required
                />
                @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo: Matrícula -->
            <div>
                <x-input-label for="matricula" :value="__('Ingrese la matricula del estudiante')"/>
                <x-text-input
                    type="text"
                    name="matricula"
                    id="matricula"
                    class="block w-full !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Ingresa la matrícula del estudiante"
                    :value="old('matricula', $estudiante->matricula ?? '')"
                    required
                />
                @error('matricula')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if(request()->routeIs('estudiantes.edit'))
                <!-- Campo: Estado -->
                <div>
                    <x-input-label for="estado" :value="__('Estado del estudiante')"/>
                    <select
                        name="status"
                        id="estado"
                        class="block w-full !py-3.5 border border-gray-300 mb-6 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                        <option value="">Seleccione el estado del estudiante</option>
                        <option value="1" {{ old('estado', $estudiante->status ?? '') == 1 ? 'selected' : '' }}>Activo
                        </option>
                        <option value="0" {{ old('estado', $estudiante->status ?? '') == 0 ? 'selected' : '' }}>
                            Inactivo
                        </option>
                    </select>
                </div>
            @endif

            @php
                $initialSelected = collect($materiasSeleccionadas ?? []);
                if (old('materias')) {
                    $initialSelected = $materias->whereIn('id', old('materias'))->values();
                }
            @endphp

            <!-- Campo: Materias -->
            <div
                x-data="dropdown({ items: {{ $materias->toJson() }}, selectedItems: {{ json_encode($initialSelected) }} })"
                @click.away="hideDropdown()">
                <x-input-label for="materias" :value="__('Seleccione las materias del estudiante')"/>
                <div class="relative mt-1">
                    <input
                        type="text"
                        placeholder="Busca o selecciona materias"
                        x-model="search"
                        x-on:focus="showDropdown()"
                        class="block w-full !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    />

                    <ul
                        class="absolute z-10 bg-white border border-gray-300 rounded-md mt-1 w-full max-h-40 overflow-auto shadow-lg"
                        x-show="isOpen && filteredItems.length > 0"
                        x-transition
                        x-cloak
                    >
                        <template x-for="(item, index) in filteredItems" :key="index">
                            <li
                                @click="selectItem(item)"
                                class="px-4 py-2 hover:bg-blue-100 cursor-pointer"
                            >
                                <span x-text="item.nombre"></span>
                            </li>
                        </template>
                    </ul>
                </div>
                <div class="mt-2">
                    <template x-for="item in selectedItems" :key="item.id">
                        <div
                            class="inline-flex items-center bg-gray-100 text-black rounded-full px-3 py-1 mr-2 mb-2">
                            <span x-text="item.nombre"></span>
                            <button
                                type="button"
                                @click="removeItem(item)"
                                class="ml-2 text-red-500 hover:text-red-700"
                            >
                                &times;
                            </button>
                            <input type="hidden" name="materias[]" :value="item.id"/>
                        </div>
                    </template>
                </div>
            </div>
            @error('materias')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

            <!-- Botón: Guardar -->
            <div class="text-right">
                <x-primary-button
                    type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    {{ isset($estudiante) ? 'Guardar Cambios' : 'Crear Estudiante' }}
                </x-primary-button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            function dropdown({items, selectedItems = []}) {

                return {
                    items,
                    search: '',
                    selectedItems: selectedItems || [], // Inicializa con las materias seleccionadas en la edición
                    isOpen: false,
                    get filteredItems() {
                        return this.search === ''
                            ? this.items
                            : this.items.filter((item) =>
                                item.nombre.toLowerCase().includes(this.search.toLowerCase())
                            );
                    },
                    showDropdown() {
                        this.isOpen = true;
                    },
                    hideDropdown() {
                        this.isOpen = false;
                    },
                    selectItem(item) {
                        if (!this.selectedItems.some((i) => i.id === item.id)) {
                            this.selectedItems.push(item);
                        }
                        this.search = '';
                        this.hideDropdown();
                    },
                    removeItem(item) {
                        this.selectedItems = this.selectedItems.filter((i) => i.id !== item.id);
                    },
                };
            }

        </script>
    @endpush

</x-app-layout>
