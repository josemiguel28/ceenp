<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CEENP') }}</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @stack('styles')

</head>
<body class="font-sans text-gray-900 antialiased container mx-auto">

<header class="py-6 px-4 md:px-8">
    <div class="flex flex-col md:flex-row gap-4 md:gap-8 items-center">
        <div class="flex-shrink-0">
            <x-application-logo class="w-16 h-16 md:w-20 md:h-20 fill-current text-gray-500"/>
        </div>

        <div class="text-center md:text-left">
            <p class="text-xl md:text-2xl md:font-semibold leading-tight">
                Maestría en Neuropedagogía, cognición y didáctica
            </p>
        </div>
    </div>
</header>


<div class="mt-8 lg:mt-0 md:flex md:justify-center md:gap-10 md:items-center">

    <div class="md:w-5/12">
        {{ $slot }}
    </div>

    <div class="md:w-6/12 p-8 hidden md:block">
        <picture>
            <source srcset="{{ asset('/img/login_img.webp') }}" type="image/webp">
            <img
                loading="lazy"
                class="w-full max-w-xl h-auto mx-auto"
                src="{{ asset('/img/login_img.png') }}"
                alt="login img">
        </picture>
    </div>

</div>
</body>
</html>
