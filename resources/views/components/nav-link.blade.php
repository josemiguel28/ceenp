@props(['active'])

@php
    $baseStyles = 'flex items-center p-2 text-sm font-medium transition duration-150 ease-in-out';
    $activeStyles = 'text-indigo-600 border-l-4 border-indigo-600 font-semibold';
    $inactiveStyles = 'text-gray-700 hover:text-gray-900 hover:bg-gray-100';

    $classes = ($active ?? false)
                ? $baseStyles . ' ' . $activeStyles
                : $baseStyles . ' ' . $inactiveStyles;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
