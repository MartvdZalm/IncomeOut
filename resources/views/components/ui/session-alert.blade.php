@props([
    'type' => 'success',
])

@php
    $classes = match ($type) {
        'success' => 'bg-green-100 dark:bg-green-900/30 border-green-400 dark:border-green-700 text-green-700 dark:text-green-200',
        'error' => 'bg-red-100 dark:bg-red-900/30 border-red-400 dark:border-red-700 text-red-700 dark:text-red-200',
        default => 'bg-blue-100 dark:bg-blue-900/30 border-blue-400 dark:border-blue-700 text-blue-700 dark:text-blue-200',
    };
@endphp

@php
    $message = match ($type) {
        'success' => session('success'),
        'error' => session('error'),
        default => session($type),
    };
@endphp
@if ($message)
    <div {{ $attributes->merge([
        'class' => "border px-4 py-3 rounded relative {$classes}",
        'role' => 'alert',
    ]) }}>
        <span class="block sm:inline">{{ $message }}</span>
    </div>
@endif
