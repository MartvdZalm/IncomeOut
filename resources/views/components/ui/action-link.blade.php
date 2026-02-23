@props([
    'variant' => 'primary',
])

@php
    $classes = match ($variant) {
        'primary' => 'text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300',
        'danger' => 'text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300',
        'success' => 'text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300',
        default => 'text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300',
    };
@endphp

<a {{ $attributes->merge(['class' => "text-sm font-medium {$classes}"]) }}>
    {{ $slot }}
</a>
