@props(['active'])

@php
$classes = ($active ?? false)
    ? 'text-pink-500 hover:text-pink-700'
    : 'text-gray-700 hover:text-pink-500';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>