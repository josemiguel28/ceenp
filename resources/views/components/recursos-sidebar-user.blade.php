@php use Illuminate\Support\Facades\Storage; @endphp
<div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-bold mb-4 text-gray-700">Recursos de este curso</h3>

    <div class="space-y-4">

        @if($materiales->isEmpty())
            <div class="bg-white rounded-lg overflow-hidden">
                <div class="p-4">
                    <h3 class="text-sm text-gray-600">No hay materiales disponibles para esta clase.</h3>
                </div>
            </div>
        @endif

        @foreach($materiales as $material)
            @php
                $fileUrl = Storage::url($material->archivo);
                $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
            @endphp

            <div
                class="bg-gray-100 rounded-lg p-4 flex items-center justify-between md:flex-col md:items-start md:gap-4">
                <div class="flex items-center space-x-4">
                    @if(in_array($fileExtension, ['mp4', 'mov', 'avi', 'webm']))
                        <!-- Ícono de video -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                             viewBox="0 0 24 24">
                            <path fill="#eab308"
                                  d="m11.5 14.5l7-4.5l-7-4.5zM6 18V2h16v16zm2-2h12V4H8zm-6 6V6h2v14h14v2zM8 4v12z"/>
                        </svg>
                    @elseif(in_array($fileExtension, ['pdf']))
                        <!-- Ícono de PDF -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                             viewBox="0 0 24 24">
                            <g fill="none" stroke="#eab308" stroke-linecap="round"
                               stroke-linejoin="round" stroke-width="1.5" color="#eab308">
                                <path
                                    d="M3.5 13v-.804c0-2.967 0-4.45.469-5.636c.754-1.905 2.348-3.407 4.37-4.118C9.595 2 11.168 2 14.318 2c1.798 0 2.698 0 3.416.253c1.155.406 2.066 1.264 2.497 2.353c.268.677.268 1.525.268 3.22V13"/>
                                <path
                                    d="M3.5 12a3.333 3.333 0 0 1 3.333-3.333c.666 0 1.451.116 2.098-.057a1.67 1.67 0 0 0 1.179-1.18c.173-.647.057-1.432.057-2.098A3.333 3.333 0 0 1 13.5 2m-10 20v-3m0 0v-1.8c0-.566 0-.848.176-1.024C3.85 16 4.134 16 4.7 16h.8a1.5 1.5 0 0 1 0 3zm17-3H19c-.943 0-1.414 0-1.707.293S17 17.057 17 18v1m0 3v-3m0 0h2.5M14 19a3 3 0 0 1-3 3c-.374 0-.56 0-.7-.08c-.333-.193-.3-.582-.3-.92v-4c0-.338-.033-.727.3-.92c.14-.08.326-.08.7-.08a3 3 0 0 1 3 3"/>
                            </g>
                        </svg>
                    @elseif(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                        <!-- Ícono de Imagen -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                             viewBox="0 0 24 24">
                            <path fill="#eab308"
                                  d="M5 3h13a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3m0 1a2 2 0 0 0-2 2v11.59l4.29-4.3l2.5 2.5l5-5L20 16V6a2 2 0 0 0-2-2zm4.79 13.21l-2.5-2.5L3 19a2 2 0 0 0 2 2h13a2 2 0 0 0 2-2v-1.59l-5.21-5.2zM7.5 6A2.5 2.5 0 0 1 10 8.5A2.5 2.5 0 0 1 7.5 11A2.5 2.5 0 0 1 5 8.5A2.5 2.5 0 0 1 7.5 6m0 1A1.5 1.5 0 0 0 6 8.5A1.5 1.5 0 0 0 7.5 10A1.5 1.5 0 0 0 9 8.5A1.5 1.5 0 0 0 7.5 7"/>
                        </svg>
                    @else
                        <!-- Ícono de archivo genérico -->
                        <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 2h9l6 6v14a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2z"></path>
                        </svg>
                    @endif

                    <div>
                        <div class="text-lg font-semibold">{{ $material->titulo }}</div>
                        <div class="text-sm text-gray-600">{{ strtoupper($fileExtension) }}</div>
                    </div>
                </div>

                <a href="{{ $fileUrl }}" target="_blank"
                   class="bg-secondary-default text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition text-center md:w-full ">
                    Ver material
                </a>

                @if(auth()->user()->role_id == 3)

                    <form action="{{ route('maestro.materias.recurso.destroy', $material) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class=" text-red-500 px-4 py-2 rounded-lg hover:bg-red-200 transition text-center md:w-full ">

                            Eliminar material
                        </button>
                    </form>

                @endif

            </div>
        @endforeach
    </div>

    <div class="py-4">
        {{ $materiales->links() }}
    </div>
</div>
