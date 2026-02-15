@props(['id', 'name' => null, 'label' => null])

@php
    $selectName = $name ?? $id;
@endphp

<div>
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif

    <select id="{{ $id }}" name="{{ $selectName }}"
        {{ $attributes->merge([
            'class' => 'w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm
                                                     focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400',
        ]) }}>
        {{ $slot }}
    </select>
</div>
