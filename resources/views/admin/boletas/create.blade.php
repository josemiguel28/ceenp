<x-app-layout>
    @push('styles')
        <!-- Dropzone CSS -->
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    @endpush

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            Crear Boleta
        </h2>

        <!-- Contenedor de dos columnas -->
        <div class="grid grid-cols-1 gap-6">

            <!-- Dropzone para subir archivos -->
            <div>
                <form action="{{ route('upload.resources') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="dropzone"
                      id="dropzone"
                >
                    @csrf
                    <input type="hidden" id="archivo_path" name="context" value="boletas.create">
                    <!-- Envía el contexto para guardar el PDF -->
                    <div class="fallback">
                        <input name="file" type="file"/>
                    </div>
                </form>

                @error('archivo_path')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror

            </div>

            <!-- Formulario principal -->
            <form action="{{ route('boletas.store') }}" method="POST">
                @csrf

                <!-- Campo oculto para la ruta del archivo -->
                <input type="hidden" name="archivo_path" id="archivo_path">

                <div>
                    <x-input-label for="alumno" :value="__('Seleccione el estudiante')"/>
                    <select
                        name="user_id"
                        id="alumno"
                        class="block w-full !py-3.5 border border-gray-300 mb-6 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"

                    >
                        <option value="">Seleccione un alumno</option>
                        @foreach($alumnos as $alumno)
                            <option {{ old('user_id') ? 'selected' : '' }} value="{{ $alumno->id }}">{{ $alumno->name }}</option>
                        @endforeach
                    </select>


                    @error('user_id')
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
        </div>
    </div>

</x-app-layout>
