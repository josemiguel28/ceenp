<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @stack('styles')

    @stack('scripts')
</head>

<body class="font-sans antialiased">

@include('layouts.navigation')


<div class=" bg-gray-100 flex">

    <!-- Sidebar responsive -->
    <x-admin-sidebar-responsive></x-admin-sidebar-responsive>

    <!-- Page Content -->
    <main class="flex-1 p-12 w-full">
        {{ $slot }}
    </main>
</div>

</body>
</html>
