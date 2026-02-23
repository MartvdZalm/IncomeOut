@props([
    'icon' => null,
    'title',
    'description' => null,
    'action' => null,
])

<div {{ $attributes->merge([
    'class' => 'bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-12 text-center',
]) }}>
    @if ($icon)
        <div class="flex justify-center text-gray-400 dark:text-gray-500">
            {{ $icon }}
        </div>
    @else
        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
    @endif
    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $title }}</h3>
    @if ($description)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $description }}</p>
    @endif
    @if ($action)
        <div class="mt-6">{{ $action }}</div>
    @endif
</div>
