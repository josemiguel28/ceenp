<div class="mb-8">
    @php
        $hora = now()->format('H');
        if ($hora < 12) {
            $saludo = 'Buenos días';
        } elseif ($hora < 18) {
            $saludo = 'Buenas tardes';
        } else {
            $saludo = 'Buenas noches';
        }
    @endphp

    <h2 class="text-2xl font-semibold">{{ $saludo }}, {{ auth()->user()->name }}</h2>
</div>

<h1 class="text-xl mb-4">Tus cursos</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

    <!-- Courses -->
    @foreach($materias as $materia)
        <div
            class="bg-white shadow-md rounded-lg border border-transparent transition transform hover:-translate-y-2 hover:shadow-lg hover:border-blue-500 flex flex-col aos-init"
            data-aos="fade-right">
            @php
                $routeName = request()->routeIs('maestro.dashboard.index') ? 'maestro.show' : 'estudiante.show';
            @endphp

            <a href="{{ route($routeName, $materia->id) }}" class="flex-grow">
                <div>
                    <picture>
                        <source srcset="{{ asset('img/courses/1_background.png') }}" type="image/webp">
                        <source srcset="{{ asset('img/courses/1_background.png') }}" type="image/jpeg">
                        <img loading="lazy" class="rounded-t-lg w-full h-40 object-fit"
                             src="{{ asset('img/courses/1_background.png') }}" alt="img curso">
                    </picture>
                </div>
                <div class="p-4">
                    <h3 class="text-xl font-semibold">{{ $materia->nombre }}</h3>
                    <p class="text-gray-700">

                    @if(!request()->routeIs('maestro.dashboard.index'))

                        @php
                            // Verificar si la materia tiene tareas pendientes
                            $tareaPendiente = $materia->tareas->some(function ($tarea) {
                                return !$tarea->entregas->contains('user_id', Auth::id());
                            });
                        @endphp

                        @if($tareaPendiente)
                            <p class="text-red-600 text-sm flex items-center">
                                <span class="w-2 h-2 bg-red-600 rounded-full inline-block mr-2"></span>
                                Tienes tareas pendientes
                            </p>
                        @else
                            <p class="text-green-600 text-sm flex items-center">
                                <span class="w-2 h-2 bg-green-600 rounded-full inline-block mr-2"></span>
                                No tienes tareas pendientes
                            </p>
                        @endif
                    @endif

                </div>
            </a>

            <div class="mt-4 text-right">
                <a href="{{ route($routeName, $materia->id) }}"
                   class="inline-flex items-center px-6 py-3 bg-secondary-default border
    border-transparent rounded-md font-semibold text-xs text-white uppercase
    tracking-widest transition hover:bg-blue-700 mb-4 mr-4 " >
                    Ver materia
                </a>
            </div>
        </div>
    @endforeach

</div>
