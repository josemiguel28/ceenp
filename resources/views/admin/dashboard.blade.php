<x-app-layout>
    <h2 class="font-semibold text-2xl">Panel de administrador</h2>

    <p class="text-gray-500 mt-4">Hola <span class="font-semibold"> {{ $crrntUser }} </span>👋 !Bienvenido de nuevo!</p>


    <div class="grid grid-cols-1 mt-8 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center space-x-4">
            <div class="bg-yellow-100 rounded-full p-4">
                <!-- Ícono del maestro -->
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 256 256">
                    <path fill="#635000"
                          d="m226.53 56.41l-96-32a8 8 0 0 0-5.06 0l-96 32A8 8 0 0 0 24 64v80a8 8 0 0 0 16 0V75.1l33.59 11.19a64 64 0 0 0 20.65 88.05c-18 7.06-33.56 19.83-44.94 37.29a8 8 0 1 0 13.4 8.74C77.77 197.25 101.57 184 128 184s50.23 13.25 65.3 36.37a8 8 0 0 0 13.4-8.74c-11.38-17.46-27-30.23-44.94-37.29a64 64 0 0 0 20.65-88l44.12-14.7a8 8 0 0 0 0-15.18ZM176 120a48 48 0 1 1-86.65-28.45l36.12 12a8 8 0 0 0 5.06 0l36.12-12A47.9 47.9 0 0 1 176 120m-48-32.43L57.3 64L128 40.43L198.7 64Z"/>
                </svg>

            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800"> {{ $totalStudents }}</p>
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
                <p class="text-3xl font-bold text-gray-800">30</p>
                <p class="text-gray-600">Maestros registrados</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center space-x-4">
            <div class="bg-yellow-100 rounded-full p-4">
                <!-- Ícono de libros -->
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 256 256"><path fill="#635000" d="m231.65 194.55l-33.19-157.8a16 16 0 0 0-19-12.39l-46.81 10.06a16.08 16.08 0 0 0-12.3 19l33.19 157.8A16 16 0 0 0 169.16 224a16.3 16.3 0 0 0 3.38-.36l46.81-10.06a16.09 16.09 0 0 0 12.3-19.03M136 50.15v-.09l46.8-10l3.33 15.87L139.33 66Zm6.62 31.47l46.82-10.05l3.34 15.9L146 97.53Zm6.64 31.57l46.82-10.06l13.3 63.24l-46.82 10.06ZM216 197.94l-46.8 10l-3.33-15.87l46.8-10.07l3.33 15.85zM104 32H56a16 16 0 0 0-16 16v160a16 16 0 0 0 16 16h48a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16M56 48h48v16H56Zm0 32h48v96H56Zm48 128H56v-16h48z"/></svg>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-800">30</p>
                <p class="text-gray-600">Materias registrados</p>
            </div>
        </div>
    </div>

</x-app-layout>
