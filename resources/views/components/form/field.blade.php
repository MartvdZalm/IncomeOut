@props([
    'label' => null,
    'id' => null,
    'error' => null,
])

<div {{ $attributes->only('class')->merge(['class' => '']) }}>
    @if ($label && $id)
        <x-form.input-label :for="$id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </x-form.input-label>
    @endif
    {{ $slot }}
    @if ($error)
        <x-form.input-error :messages="$error" class="mt-1" />
    @endif
</div>
