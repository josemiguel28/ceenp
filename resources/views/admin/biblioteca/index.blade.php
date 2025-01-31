<x-app-layout>

    <h1 class="font-semibold text-2xl">Biblioteca</h1>
    <p class="text-gray-500">Gestiona los recursos generales de los estudiantes desde aqui.</p>


    <div class="mb-4 mt-8">
        <a href=" {{ route('biblioteca.create') }}">
            <x-primary-button>
                {{ __('Nuevo Recurso') }} +
            </x-primary-button>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="relative mt-8 flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
            <div class="flex flex-col justify-between gap-8 mb-4 md:flex-row md:items-center">
                <div class="mt-4">
                    <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                        Recursos generales
                    </h5>
                    <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                        Estos son los recursos generales disponibles para todos los estudiantes.
                    </p>
                </div>
            </div>
        </div>

        <!-- Contenedor con desplazamiento horizontal -->
        <div class="p-6 overflow-x-auto w-full">
            <table class="w-full min-w-[640px] text-left table-auto">
                <thead>
                <tr>
                    <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                        <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                            Recurso
                        </p>
                    </th>
                    <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                        <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                            Tipo
                        </p>
                    </th>
                    <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                        <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                            Registrado
                        </p>
                    </th>
                    <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                        <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        </p>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($recursos as $recurso)
                    <tr>
                        <td class="p-4 border-b border-blue-gray-50">
                            <div class="flex items-center gap-3">
                                <img src=" {{ asset('img/file_image.jpg') }}" alt="file image"
                                     class="relative inline-block h-12 w-12 !rounded-full border border-blue-gray-50 bg-blue-gray-50/50 object-contain object-center p-1"/>

                                <p class="block font-sans text-sm antialiased font-bold leading-normal text-blue-gray-900">
                                    {{ $recurso->titulo }}
                                </p>
                            </div>
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            <div class="w-max">
                                <div
                                    @php
                                        // Definir el color y el texto según el tipo de recurso
                                        if ($recurso->tipo === 'pdf') {
                                            $tipoTexto = 'PDF';
                                            $tipoColor = 'bg-blue-100 text-blue-900'; // Color para PDF
                                            $tipoAccion = asset('storage/' . $recurso->archivo); // Ruta del PDF
                                        } elseif ($recurso->tipo === 'enlace') {
                                            $tipoTexto = 'Enlace';
                                            $tipoColor = 'bg-purple-100 text-purple-900'; // Color para enlace
                                            $tipoAccion = $recurso->enlace; // URL del enlace
                                        } else {
                                            $tipoTexto = 'Desconocido';
                                            $tipoColor = 'bg-gray-100 text-gray-900'; // Color por defecto
                                            $tipoAccion = '#'; // Acción por defecto
                                        }
                                    @endphp
                                    class="relative grid items-center px-2 py-1 font-sans text-xs font-bold uppercase rounded-md select-none whitespace-nowrap {{ $tipoColor }}">
                                    <a href="{{ $tipoAccion }}" target="_blank" class="hover:underline">
                                        {{ $tipoTexto }}
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                {{ $recurso->created_at->diffForHumans() }}
                            </p>
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">

                            <form action="{{ route('biblioteca.destroy', $recurso->id) }}" method="post"
                                  onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="submit">
                                        <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 48 48">
                                                <g fill="none" stroke="#dc2626" stroke-linejoin="round" stroke-width="4">
                                                    <path d="M9 10v34h30V10z"/>
                                                    <path stroke-linecap="round" d="M20 20v13m8-13v13M4 10h40"/>
                                                    <path d="m16 10l3.289-6h9.488L32 10z"/>
                                                </g>
                                            </svg>
                                        </span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $recursos->links() }}
            </div>
        </div>

        @push('scripts')
            <script>
                function confirmDelete() {
                    return confirm('¿Estás seguro de que deseas eliminar este recurso?');
                }
            </script>
        @endpush
    </div>


</x-app-layout>
