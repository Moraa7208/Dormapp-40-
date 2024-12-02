@props(['href', 'active', 'role', 'text'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold text-xl rounded-md transition-all duration-300'
                : 'inline-flex items-center px-6 py-3 bg-gray-100 text-gray-900 font-semibold text-xl hover:bg-blue-600 hover:text-white rounded-md transition-all duration-300';
@endphp

@if (isset($role) && Auth::user()->hasRole($role))
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ __($text) }}
    </a>
@endif
