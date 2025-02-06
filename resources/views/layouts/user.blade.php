<!-- resources/views/layouts/edu.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Plataforma Educativa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('layouts.navigation')

<div class="container mx-auto px-4 py-8">
    @yield('content')
</div>

@stack('scripts')
</body>
</html>
