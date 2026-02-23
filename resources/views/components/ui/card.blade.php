@props([])

<div {{ $attributes->merge([
    'class' => 'bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700',
]) }}>
    {{ $slot }}
</div>
