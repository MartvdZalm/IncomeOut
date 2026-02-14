<div
    {{
        $attributes->merge([
            'class' => 'hidden bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 text-sm rounded-lg p-3',
        ])
    }}
>
    {{ $slot }}
</div>
