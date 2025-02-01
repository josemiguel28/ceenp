<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <h1 class="font-semibold text-2xl">Materias</h1>
        <p class="text-gray-500">Gestiona las materias desde aqui.</p>


        <div class="mb-4 mt-8">
            <a href=" {{ route('materias.create') }}">
                <x-primary-button>
                    {{ __('Nuevo Materia') }} +
                </x-primary-button>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div
            class="relative mt-8 flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
                <div class="flex flex-col justify-between gap-8 mb-4 md:flex-row md:items-center">
                    <div class="mt-4">
                        <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            Materias registradas
                        </h5>
                        <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                            Estos son las materias registradas en el sistema.
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
                                Materia
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Semestre
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Registrada
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                            </p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($materias as $materia)
                        <tr>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <img src=" {{ asset('img/book_img.jpg') }}" alt="books image"
                                         class="relative inline-block h-12 w-12 !rounded-full border border-blue-gray-50 bg-blue-gray-50/50 object-contain object-center p-1"/>

                                    <p class="block font-sans text-sm antialiased font-bold leading-normal text-blue-gray-900">
                                        {{ $materia->nombre }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">

                                @php
                                    $styles = $materia->semestre == 1 ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800';

                                @endphp

                                <span class="px-2 py-1 font-sans text-xs font-bold uppercase rounded-md select-none whitespace-nowrap {{ $styles }}">
                                    {{ $materia->semestre == 1 ? 'Primer semestre' : 'Segundo semestre' }}
                                </span>
                            </td>

                            <td class="p-4 border-b border-blue-gray-50">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $materia->created_at->diffForHumans() ?? 'Sin fecha de registro' }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">

                                <a href="{{ route('materias.edit', $materia->id) }}">
                                    <button
                                        class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                              <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                     aria-hidden="true" class="w-4 h-4">
                                                  <path
                                                      d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"></path>
                                                </svg>
                                              </span>
                                    </button>
                                </a>

                                <form action="{{ route('materias.destroy', $materia->id) }}" method="post"
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
                    {{ $materias->links() }}
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete() {
                return confirm('¿Estás seguro de que deseas eliminar esta materia?');
            }
        </script>
    @endpush
</x-app-layout>
