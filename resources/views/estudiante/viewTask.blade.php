@extends('layouts.user')

@section('title', 'Cursos - ' . $tarea->nombre )

@section('content')

    @push('styles')
        <!-- Dropzone CSS -->
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    @endpush

    <h2 class="text-2xl font-semibold mb-4"> {{ $tarea->titulo }}</h2>

    <div class=" mx-auto bg-gray-100 p-6 rounded-2xl shadow-md">

        <p class="text-gray-700 mb-4">
            {{ $tarea->descripcion }}
        </p>

        <div class="flex flex-col text-gray-600 mt-3 space-x-8 space-y-4">
            <div class="flex items-center space-x-1">
                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="#eab308"
                          d="M11.5 3a9.5 9.5 0 0 1 9.5 9.5a9.5 9.5 0 0 1-9.5 9.5A9.5 9.5 0 0 1 2 12.5A9.5 9.5 0 0 1 11.5 3m0 1A8.5 8.5 0 0 0 3 12.5a8.5 8.5 0 0 0 8.5 8.5a8.5 8.5 0 0 0 8.5-8.5A8.5 8.5 0 0 0 11.5 4M11 7h1v5.42l4.7 2.71l-.5.87l-5.2-3z"/>
                </svg>
                <span>
                @if ($tareaVencida)
                        <span class="text-red-500">Fecha de entrega vencida</span>
                    @else
                        Se entrega <span
                            class="font-semibold"> {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->translatedFormat('d F Y h:i A') }} </span>
                    @endif
            </span>
            </div>
            <div class="flex items-center space-x-1">
                <svg width="24" height="24" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20.09 6.12314C20.164 5.94259 20.2901 5.78814 20.4521 5.67944C20.6142 5.57074 20.8049 5.5127 21 5.5127C21.1951 5.5127 21.3858 5.57074 21.5479 5.67944C21.7099 5.78814 21.836 5.94259 21.91 6.12314L25.6287 15.0674C25.6984 15.2347 25.8128 15.3797 25.9594 15.4862C26.1061 15.5927 26.2793 15.6567 26.46 15.6711L36.1165 16.4446C36.9897 16.5146 37.3432 17.6049 36.6782 18.1736L29.3212 24.4771C29.1838 24.5947 29.0814 24.7479 29.0252 24.9198C28.969 25.0917 28.9612 25.2758 29.0027 25.4519L31.2515 34.8756C31.2967 35.0647 31.2848 35.2629 31.2175 35.4453C31.1501 35.6276 31.0301 35.7859 30.8729 35.9001C30.7156 36.0143 30.5279 36.0794 30.3337 36.087C30.1395 36.0947 29.9473 36.0446 29.7815 35.9431L21.5127 30.8944C21.3584 30.8001 21.1809 30.7501 21 30.7501C20.8191 30.7501 20.6416 30.8001 20.4872 30.8944L12.2185 35.9449C12.0527 36.0464 11.8605 36.0964 11.6663 36.0888C11.4721 36.0811 11.2844 36.0161 11.1271 35.9019C10.9698 35.7876 10.8499 35.6294 10.7825 35.447C10.7151 35.2647 10.7033 35.0665 10.7485 34.8774L12.9972 25.4519C13.039 25.2758 13.0313 25.0917 12.9751 24.9197C12.9189 24.7477 12.8164 24.5946 12.6787 24.4771L5.32175 18.1736C5.1736 18.0473 5.06626 17.8799 5.01333 17.6926C4.96039 17.5053 4.96425 17.3064 5.0244 17.1213C5.08456 16.9361 5.1983 16.773 5.35124 16.6525C5.50417 16.5321 5.68941 16.4597 5.8835 16.4446L15.54 15.6711C15.7207 15.6567 15.8939 15.5927 16.0405 15.4862C16.1872 15.3797 16.3016 15.2347 16.3712 15.0674L20.09 6.12314Z"
                        stroke="#DDB204" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <span class="">Sin calificar aún</span>
            </div>
        </div>

        <!-- Dropzone para subir archivos -->
        <form action="{{ route('upload.resources') }}"
              method="POST"
              enctype="multipart/form-data"
              class="dropzone"
              id="dropzone"
        >
            @csrf
            <input type="hidden" name="context" value="estudiante.create.task">
            <!-- Envía el contexto para guardar el PDF -->
            <div class="fallback">
                <input name="file" type="file"/>
            </div>
        </form>

        <p class="mt-4 text-gray-600 font-semibold">Observación</p>

    </div>

@endsection


