<x-app-layout>
    <h1 class="font-semibold text-2xl">Panel de administrador</h1>
    <p class="text-gray-500">Hola <span class="font-semibold"> {{ $crrntUser }} </span>👋 !Bienvenido de nuevo!</p>

    <!-- Mensaje de error -->
    <x-error-message/>

    <!-- Estadísticas -->
    <div class="grid grid-cols-1 gap-4 mt-8 mb-16 md:grid-cols-2 lg:grid-cols-3">
        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center space-x-4">
            <div class="bg-yellow-100 rounded-full p-4">
                <!-- Ícono del maestro -->
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 256 256">
                    <path fill="#635000"
                          d="m226.53 56.41l-96-32a8 8 0 0 0-5.06 0l-96 32A8 8 0 0 0 24 64v80a8 8 0 0 0 16 0V75.1l33.59 11.19a64 64 0 0 0 20.65 88.05c-18 7.06-33.56 19.83-44.94 37.29a8 8 0 1 0 13.4 8.74C77.77 197.25 101.57 184 128 184s50.23 13.25 65.3 36.37a8 8 0 0 0 13.4-8.74c-11.38-17.46-27-30.23-44.94-37.29a64 64 0 0 0 20.65-88l44.12-14.7a8 8 0 0 0 0-15.18ZM176 120a48 48 0 1 1-86.65-28.45l36.12 12a8 8 0 0 0 5.06 0l36.12-12A47.9 47.9 0 0 1 176 120m-48-32.43L57.3 64L128 40.43L198.7 64Z"/>
                </svg>

            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800"> {{ $students->count() }}</p>
                <p class="text-gray-600">Estudiantes registrados</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center space-x-4">
            <div class="bg-yellow-100 rounded-full p-4">
                <!-- Ícono del birrete -->
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                    <g fill="none" stroke="#635000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                       color="#635000">
                        <path
                            d="M2 2h14c1.886 0 2.828 0 3.414.586S20 4.114 20 6v6c0 1.886 0 2.828-.586 3.414S17.886 16 16 16H9m1-9.5h6M2 17v-4c0-.943 0-1.414.293-1.707S3.057 11 4 11h2m-4 6h4m-4 0v5m4-5v-6m0 6v5m0-11h6"/>
                        <path d="M6 6.5a2 2 0 1 1-4 0a2 2 0 0 1 4 0"/>
                    </g>
                </svg>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800">{{ $teachers->count() }}</p>
                <p class="text-gray-600">Maestros registrados</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center space-x-4">
            <div class="bg-yellow-100 rounded-full p-4">
                <!-- Ícono de libros -->
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 256 256">
                    <path fill="#635000"
                          d="m231.65 194.55l-33.19-157.8a16 16 0 0 0-19-12.39l-46.81 10.06a16.08 16.08 0 0 0-12.3 19l33.19 157.8A16 16 0 0 0 169.16 224a16.3 16.3 0 0 0 3.38-.36l46.81-10.06a16.09 16.09 0 0 0 12.3-19.03M136 50.15v-.09l46.8-10l3.33 15.87L139.33 66Zm6.62 31.47l46.82-10.05l3.34 15.9L146 97.53Zm6.64 31.57l46.82-10.06l13.3 63.24l-46.82 10.06ZM216 197.94l-46.8 10l-3.33-15.87l46.8-10.07l3.33 15.85zM104 32H56a16 16 0 0 0-16 16v160a16 16 0 0 0 16 16h48a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16M56 48h48v16H56Zm0 32h48v96H56Zm48 128H56v-16h48z"/>
                </svg>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800">{{ $materias->count() }}</p>
                <p class="text-gray-600">Materias registradas</p>
            </div>
        </div>
    </div>

    <!-- Acceso rapido-->
    <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
        Acceso rápido
    </h5>

    <p class="text-gray-500">Accede rápidamente a estas funcionalidades.</p>

    <div class="grid grid-cols-1 mt-8 mb-16 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center space-x-4">

            <div class="bg-yellow-100 rounded-full p-4">
                <!-- Ícono del estudiante -->
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                    <g fill="none" stroke="#635000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                       color="#635000">
                        <path
                            d="M14 3.5c3.771 0 5.657 0 6.828 1.245S22 7.993 22 12s0 6.01-1.172 7.255S17.771 20.5 14 20.5h-4c-3.771 0-5.657 0-6.828-1.245S2 16.007 2 12s0-6.01 1.172-7.255S6.229 3.5 10 3.5z"/>
                        <path
                            d="M5 15.5c1.609-2.137 5.354-2.254 7 0m-1.751-5.25a1.75 1.75 0 1 1-3.5 0a1.75 1.75 0 0 1 3.5 0M15 9.5h4m-4 4h2"/>
                    </g>
                </svg>

            </div>
            <div>
                <p class="text-xl font-bold text-gray-800"> Agregar un estudiante</p>
                <p class="text-gray-600 text-sm">Registra un estudiante en el sistema.</p>

                <a class="float-right mt-4 font-semibold" href="{{ route('estudiantes.create') }}">Agregar +</a>
            </div>


        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center space-x-4">
            <div class="bg-yellow-100 rounded-full p-4">
                <!-- Ícono del maestro -->
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 256 256">
                    <path fill="#635000"
                          d="M216 40H40a16 16 0 0 0-16 16v144a16 16 0 0 0 16 16h13.39a8 8 0 0 0 7.23-4.57a48 48 0 0 1 86.76 0a8 8 0 0 0 7.23 4.57H216a16 16 0 0 0 16-16V56a16 16 0 0 0-16-16M80 144a24 24 0 1 1 24 24a24 24 0 0 1-24-24m136 56h-56.57a64.4 64.4 0 0 0-28.83-26.16a40 40 0 1 0-53.2 0A64.4 64.4 0 0 0 48.57 200H40V56h176ZM56 96V80a8 8 0 0 1 8-8h128a8 8 0 0 1 8 8v96a8 8 0 0 1-8 8h-16a8 8 0 0 1 0-16h8V88H72v8a8 8 0 0 1-16 0"/>
                </svg>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-800"> Agregar un maestro</p>
                <p class="text-gray-600 text-sm">Registra un maestro en el sistema.
                    <br>
                    <br>
                </p>

                <a class="float-right mt-4 font-semibold" href="{{ route('maestros.create') }}">Agregar +</a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center space-x-4">
            <div class="bg-yellow-100 rounded-full p-4">
                <!-- Ícono de asignature -->
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                    <path fill="#635000"
                          d="M17.25 2A2.75 2.75 0 0 1 20 4.75v14.5A2.75 2.75 0 0 1 17.25 22H6.75A2.75 2.75 0 0 1 4 19.249V4.75c0-1.26.846-2.32 2-2.647V3.75c-.304.228-.5.59-.5 1v14.498c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25V4.75c0-.69-.56-1.25-1.25-1.25H15V2zM14 2v8.139c0 .747-.8 1.027-1.29.764l-.082-.052l-2.126-1.285l-2.078 1.251c-.5.36-1.33.14-1.417-.558L7 10.14V2zm-1.5 1.5h-4v5.523l1.573-.949a.92.92 0 0 1 .818-.024l1.61.974z"/>
                </svg>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-800"> Agregar una materia</p>
                <p class="text-gray-600 text-sm">Registra una materia en el sistema.</p>

                <a class="float-right mt-4 font-semibold" href="{{ route('materias.create') }}">Agregar +</a>
            </div>
        </div>
    </div>


    <x-students-table :students="$students"/>
</x-app-layout>
