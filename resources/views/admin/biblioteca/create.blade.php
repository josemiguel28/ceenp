<x-app-layout>

    @push('styles')
        <!-- Dropzone CSS -->
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    @endpush

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            Crear Recurso
        </h2>

        <!-- Contenedor de dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Columna 1: Formulario principal -->
            <form action="{{ route('biblioteca.store') }}" method="post" enctype="multipart/form-data"
                  class="space-y-6">
                @csrf

                <!-- Campo oculto para la ruta del archivo -->
                <input type="hidden" name="archivo_path" id="archivo_path">

                <!-- Campo Título -->
                <div>
                    <x-input-label for="titulo" :value="__('Nombre del recurso')"/>
                    <x-text-input
                        type="text"
                        name="titulo"
                        id="titulo"
                        class="block w-full !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Ingresa el nombre del recurso"
                        :value="old('titulo')"
                        required
                    />
                    @error('titulo')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo Tipo de recurso -->
                <div>
                    <x-input-label for="tipo" :value="__('Tipo de recurso')"/>
                    <select
                        name="tipo"
                        id="tipo"
                        class="block w-full !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                        <option value="pdf">PDF</option>
                        <option value="enlace">Enlace</option>
                    </select>
                </div>

                <!-- Campo Enlace (oculto por defecto) -->
                <div id="enlace-field" class="hidden">
                    <x-input-label for="enlace" :value="__('Enlace')"/>
                    <x-text-input
                        type="url"
                        name="enlace"
                        id="enlace"
                        class="block w-full !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Ingresa el enlace"
                        :value="old('enlace')"
                    />
                    @error('enlace')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botón: Guardar -->
                <div class="text-right">
                    <x-primary-button
                        type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Guardar
                    </x-primary-button>
                </div>
            </form>

            <!-- Dropzone para subir archivos -->
            <div>
                <form action="{{ route('upload.resources') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="dropzone"
                      id="dropzone"
                >
                    @csrf
                    <input type="hidden" name="context" value="biblioteca.create">
                    <!-- Envía el contexto para guardar el PDF -->
                    <div class="fallback">
                        <input name="file" type="file"/>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Script para mostrar/ocultar el campo de enlace -->
    <script>
        document.getElementById('tipo').addEventListener('change', function () {
            const tipo = this.value;
            document.getElementById('dropzone').style.display = tipo === 'pdf' ? 'block' : 'none';
            document.getElementById('enlace-field').style.display = tipo === 'enlace' ? 'block' : 'none';
        });
    </script>

</x-app-layout>

