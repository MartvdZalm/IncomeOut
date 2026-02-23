@props([
    'id',
    'name' => null,
    'label' => null,
    'placeholder' => '',
    'rows' => 4,
    'value' => null,
])

@php
    $inputName = $name ?? $id;
    $current = old($inputName, $value);
@endphp

<div>
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif
    <textarea id="{{ $id }}" name="{{ $inputName }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400',
        ]) }}>{{ $current ?? trim((string) $slot) }}</textarea>
</div>
