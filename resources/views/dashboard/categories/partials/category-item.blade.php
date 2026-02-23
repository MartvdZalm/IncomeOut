<div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 flex items-center justify-between"
    style="border-left: 4px solid {{ $category->color }}">
    <div class="flex items-center gap-3">
        <div class="w-4 h-4 rounded-full" style="background-color: {{ $category->color }}"></div>
        <div>
            <h5 class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $category->name }}</h5>
            @if ($category->is_default)
                <p class="text-xs text-gray-500 dark:text-gray-400">Default</p>
            @endif
        </div>
    </div>
    @if (!$category->is_default)
        <div class="flex gap-2">
            <x-ui.button type="button" variant="link-primary" class="text-xs"
                onclick="editCategory({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ $category->type }}', '{{ $category->color }}')">
                Edit
            </x-ui.button>
            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline"
                onsubmit="return confirm('Are you sure you want to delete this category? This will not delete transactions, but they will lose their category.');">
                @csrf
                @method('DELETE')
                <x-ui.button type="submit" variant="link-danger">Delete</x-ui.button>
            </form>
        </div>
    @endif
</div>
