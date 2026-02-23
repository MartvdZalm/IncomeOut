@props([
    'tag' => 'button',
    'variant' => 'primary',
    'type' => null,
])

@php
    $base = 'inline-flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50';
    $variants = [
        'primary' => 'bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white focus:ring-blue-500 dark:focus:ring-blue-400',
        'secondary' => 'bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-500 focus:ring-gray-500',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white focus:ring-red-500',
        'ghost' => 'bg-transparent text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-gray-500',
        'link-danger' => 'bg-transparent text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 focus:ring-red-500 text-xs font-medium',
        'link-primary' => 'bg-transparent text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 focus:ring-blue-500 text-sm font-medium',
    ];
    $class = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
    $type = $type ?? ($tag === 'button' ? 'button' : null);
@endphp

@if ($tag === 'a')
    <a {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}"
        {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </button>
@endif
