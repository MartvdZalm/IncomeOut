<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Categories</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Manage Categories</h3>
                <button onclick="document.getElementById('addCategoryModal').classList.remove('hidden')" class="bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                    + Add Category
                </button>
            </div>

            <!-- Expense Categories -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6">
                <h4 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Expense Categories</h4>
                @if($expenseCategories->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach($expenseCategories as $category)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 flex items-center justify-between" style="border-left: 4px solid {{ $category->color }};">
                                <div class="flex items-center gap-3">
                                    <div class="w-4 h-4 rounded-full" style="background-color: {{ $category->color }};"></div>
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $category->name }}
                                        </h5>
                                        @if($category->is_default)
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Default</p>
                                        @endif
                                    </div>
                                </div>
                                @if(!$category->is_default)
                                    <div class="flex gap-2">
                                        <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->type }}', '{{ $category->color }}')" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-xs">
                                            Edit
                                        </button>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category? This will not delete transactions, but they will lose their category.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-xs">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">No expense categories found.</p>
                @endif
            </div>

            <!-- Income Categories -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6">
                <h4 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Income Categories</h4>
                @if($incomeCategories->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach($incomeCategories as $category)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 flex items-center justify-between" style="border-left: 4px solid {{ $category->color }};">
                                <div class="flex items-center gap-3">
                                    <div class="w-4 h-4 rounded-full" style="background-color: {{ $category->color }};"></div>
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $category->name }}
                                        </h5>
                                        @if($category->is_default)
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Default</p>
                                        @endif
                                    </div>
                                </div>
                                @if(!$category->is_default)
                                    <div class="flex gap-2">
                                        <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->type }}', '{{ $category->color }}')" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-xs">
                                            Edit
                                        </button>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category? This will not delete transactions, but they will lose their category.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-xs">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">No income categories found.</p>
                @endif
            </div>
        </div>
    </div>

    @include('dashboard.categories.partials.modals')
</x-dashboard-layout>

<script>
function editCategory(id, name, type, color) {
    document.getElementById('edit_category_id').value = id;
    document.getElementById('edit_category_name').value = name;
    document.getElementById('edit_category_type').value = type;
    document.getElementById('edit_category_color').value = color;
    document.getElementById('editCategoryModal').classList.remove('hidden');
}
</script>

