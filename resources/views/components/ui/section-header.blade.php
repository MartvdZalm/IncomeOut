@props([
    'title',
])

<div {{ $attributes->merge(['class' => 'flex justify-between items-center']) }}>
    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $title }}</h3>
    @isset($action)
        {{ $action }}
    @endisset
</div>
