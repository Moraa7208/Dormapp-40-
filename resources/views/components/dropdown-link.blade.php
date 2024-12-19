@props(['href', 'active', 'role', 'text'])

@php
    $classes = ($active ?? false)
                ? 'block w-full px-4 py-2 text-start text-sm leading-5 text-white bg-blue-600 font-semibold rounded-md transition-all duration-300'
                : 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out';
@endphp

@if (isset($role) && Auth::user()->hasRole($role))
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ __($text) }}
    </a>
@endif
