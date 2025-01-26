<div class="relative mt-8 flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
    <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
        <div class="flex flex-col justify-between gap-8 mb-4 md:flex-row md:items-center">
            <div class="mt-4">
                <h5
                    class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Estudiantes registrados
                </h5>
                <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                    Estos son los estudiantes registrados en el sistema.
                </p>
            </div>

        </div>
    </div>
    <div class="p-6 px-0 overflow-scroll">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
            <tr>
                <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Nombre
                    </p>
                </th>
                <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Correo
                    </p>
                </th>
                <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Estado
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

            @foreach($students as $student)
                <tr>
                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="flex items-center gap-3">
                            <img src="https://docs.material-tailwind.com/img/logos/logo-spotify.svg" alt="Spotify"
                                 class="relative inline-block h-12 w-12 !rounded-full border border-blue-gray-50 bg-blue-gray-50/50 object-contain object-center p-1"/>
                            <p class="block font-sans text-sm antialiased font-bold leading-normal text-blue-gray-900">
                                {{ $student->name }}
                            </p>
                        </div>
                    </td>
                    <td class="p-4 border-b border-blue-gray-50">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $student->email }}
                        </p>
                    </td>

                    <td class="p-4 border-b border-blue-gray-50">
                        <div class="w-max">
                            <div

                                @php
                                    $status = $student->status == 1 ? 'activo' : 'inactivo';
                                    $statusColor = $status === 'activo' ? 'bg-green-500' : 'bg-red-500';
                                @endphp

                                class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap {{ $statusColor }}/20">
                                <span class=""> {{ $status }} </span>
                            </div>
                        </div>
                    </td>

                    <td class="p-4 border-b border-blue-gray-50">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $student->created_at->diffForHumans() }}
                        </p>
                    </td>


                    <td class="p-4 border-b border-blue-gray-50">
                        <button
                            class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                      <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                             aria-hidden="true"
                             class="w-4 h-4">
                          <path
                              d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                          </path>
                        </svg>

                      </span>
                        </button>

                        <button
                            class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                      <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             viewBox="0 0 48 48">
                            <g fill="none"
                               stroke="#dc2626"
                               stroke-linejoin="round"
                               stroke-width="4"><path
                                    d="M9 10v34h30V10z"/><path stroke-linecap="round" d="M20 20v13m8-13v13M4 10h40"/><path
                                    d="m16 10l3.289-6h9.488L32 10z"/></g></svg>

                      </span>
                        </button>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

        <div class="mt-4">
            {{ $students->links() }}
        </div>

    </div>
</div>
