@props(['active'])

@php
$classes = $active
            ? 'inline-flex items-center px-1 pt-1 text-sm font-semibold text-gray-700'  // <- ganti dari text-blue-600
            : 'inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} style="text-decoration: none !important;">
    {{ $slot }}
</a>

