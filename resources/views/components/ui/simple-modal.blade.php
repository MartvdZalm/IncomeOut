@props([
    'id',
    'title',
])

<div id="{{ $id }}"
    class="hidden fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-75 overflow-y-auto h-full w-full z-50"
    aria-modal="true"
    role="dialog">
    <div class="relative top-20 mx-auto p-5 border dark:border-gray-700 w-full max-w-md shadow-lg rounded-lg bg-white dark:bg-gray-800">
        <div class="mt-3">
            @if ($title)
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ $title }}</h3>
            @endif
            {{ $slot }}
        </div>
    </div>
</div>
