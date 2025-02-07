<!-- resources/views/layouts/edu.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Plataforma Educativa</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    @stack('styles')

</head>
<body>
@include('layouts.navigation')

<div class="container mx-auto px-4 py-8">
    @yield('content')
</div>

@stack('scripts')
</body>
</html>
