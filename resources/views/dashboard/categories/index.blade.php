<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Categories</h2>
    </x-slot>

    <x-ui.page-container>
        <x-ui.session-alert type="success" />
        <x-ui.session-alert type="error" />

        <x-ui.section-header title="Manage Categories">
            <x-slot name="action">
                <x-ui.button type="button" onclick="document.getElementById('addCategoryModal').classList.remove('hidden')">
                    + Add Category
                </x-ui.button>
            </x-slot>
        </x-ui.section-header>

        <x-ui.card class="p-6">
            <h4 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Expense Categories</h4>
            @if ($expenseCategories->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach ($expenseCategories as $category)
                        @include('dashboard.categories.partials.category-item', ['category' => $category])
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400">No expense categories found.</p>
            @endif
        </x-ui.card>

        <x-ui.card class="p-6">
            <h4 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Income Categories</h4>
            @if ($incomeCategories->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach ($incomeCategories as $category)
                        @include('dashboard.categories.partials.category-item', ['category' => $category])
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400">No income categories found.</p>
            @endif
        </x-ui.card>
    </x-ui.page-container>

    @include('dashboard.categories.partials.modals')
</x-dashboard-layout>
