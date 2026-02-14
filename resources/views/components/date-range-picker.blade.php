@props([
    'idPrefix' => 'date-range',
    'label' => 'Date range',
    'showPresets' => false,
])

<div {{ $attributes->merge(['class' => 'flex flex-wrap gap-4 items-end']) }}
    data-date-range-picker="{{ $idPrefix }}">
    <div class="flex-1 min-w-[180px]">
        <x-input-label :for="$idPrefix . '-from'" :value="$label" />
        <input type="date" id="{{ $idPrefix }}-from"
            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400" />
    </div>

    <div class="flex-1 min-w-[180px]">
        <x-input-label :for="$idPrefix . '-to'" value="Until" />
        <input type="date" id="{{ $idPrefix }}-to"
            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400" />
    </div>

    @if ($showPresets)
        <div class="flex flex-wrap gap-2">
            <button type="button"
                class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md text-xs font-medium hover:bg-gray-200"
                data-preset="3m">
                Last 3M
            </button>
            <button type="button"
                class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md text-xs font-medium hover:bg-gray-200"
                data-preset="6m">
                Last 6M
            </button>
            <button type="button"
                class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md text-xs font-medium hover:bg-gray-200"
                data-preset="12m">
                Last 12M
            </button>
            <button type="button"
                class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md text-xs font-medium hover:bg-gray-200"
                data-preset="ytd">
                YTD
            </button>
        </div>
    @endif
</div>
