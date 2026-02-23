<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Transactions</h2>
    </x-slot>

    <x-ui.page-container>
        <x-ui.session-alert type="success" />

        <x-ui.section-header title="All Transactions">
            <x-slot name="action">
                <x-ui.button type="button"
                    onclick="document.getElementById('addTransactionModal').classList.remove('hidden')">
                    + Add Transaction
                </x-ui.button>
            </x-slot>
        </x-ui.section-header>

        <x-ui.card class="p-4">
            <form method="GET" action="{{ route('transactions.index') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <x-form.input id="filter_search" name="search" label="Search" type="text"
                        value="{{ $searchTerm ?? '' }}" placeholder="Search by description..." />
                </div>
                <div class="flex-1 min-w-[200px]">
                    <x-form.select id="filter_account" name="account_id" label="Account">
                        <option value="">All Accounts</option>
                        @foreach ($accounts as $account)
                            <option value="{{ $account->id }}"
                                {{ $selectedAccount == $account->id ? 'selected' : '' }}>
                                {{ $account->name }}
                            </option>
                        @endforeach
                    </x-form.select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <x-form.select id="filter_type" name="type" label="Type" onchange="updateCategoryFilter()">
                        <option value="">All Types</option>
                        <option value="income" {{ $selectedType == 'income' ? 'selected' : '' }}>Income</option>
                        <option value="expense" {{ $selectedType == 'expense' ? 'selected' : '' }}>Expense</option>
                    </x-form.select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <x-form.select id="filter_category" name="category_id" label="Category">
                        <option value="">All Categories</option>
                        @foreach ($categories ?? [] as $category)
                            <option value="{{ $category->id }}" data-type="{{ $category->type }}"
                                {{ ($selectedCategory ?? '') == $category->id ? 'selected' : '' }}
                                style="color: {{ $category->color }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-form.select>
                </div>
                <div class="flex items-end gap-2">
                    <x-ui.button type="submit">Filter</x-ui.button>
                    <x-ui.button tag="a" :href="route('transactions.index')" variant="secondary">Clear</x-ui.button>
                </div>
            </form>
        </x-ui.card>

        <x-ui.card class="overflow-hidden">
            @if ($transactions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Date
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Type
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Description
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Account
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Category
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($transactions as $transaction)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $transaction->date->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($transaction->is_transfer)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                                Transfer
                                            </span>
                                        @elseif ($transaction->type === 'income')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                                Income
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                                Expense
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $transaction->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $transaction->account ? $transaction->account->name : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($transaction->categoryRelation)
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium"
                                                style="
                                                        background-color: {{ $transaction->categoryRelation->color }}20;
                                                        color: {{ $transaction->categoryRelation->color }};
                                                    ">
                                                {{ $transaction->categoryRelation->name }}
                                            </span>
                                        @elseif ($transaction->category)
                                            <span class="text-gray-500 dark:text-gray-400">
                                                {{ $transaction->category }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $transaction->type === 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                        {{ $transaction->type === 'income' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('transactions.destroy', $transaction) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-ui.button type="submit" variant="link-danger">Delete</x-ui.button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-t border-gray-200 dark:border-gray-600">
                    {{ $transactions->links() }}
                </div>
            @else
                <x-ui.empty-state title="No transactions" description="Get started by adding your first transaction."
                    class="rounded-none">
                    <x-slot name="icon">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </x-slot>
                    <x-slot name="action">
                        <x-ui.button type="button"
                            onclick="document.getElementById('addTransactionModal').classList.remove('hidden')">
                            Add Transaction
                        </x-ui.button>
                    </x-slot>
                </x-ui.empty-state>
            @endif
        </x-ui.card>
    </x-ui.page-container>

    @include('dashboard.transactions.partials.modals')

    <script>
        function updateCategoryFilter() {
            const typeSelect = document.getElementById('filter_type');
            const categorySelect = document.getElementById('filter_category');
            const selectedType = typeSelect.value;

            // Show/hide options based on type
            const options = categorySelect.querySelectorAll('option[data-type]');
            options.forEach((option) => {
                if (option.value === '') {
                    option.style.display = 'block'; // Always show "All Categories"
                } else {
                    option.style.display =
                        selectedType === '' || option.getAttribute('data-type') === selectedType ? 'block' : 'none';
                }
            });

            // Reset selection if current selection doesn't match type
            const currentOption = categorySelect.options[categorySelect.selectedIndex];
            if (
                currentOption.value !== '' &&
                selectedType !== '' &&
                currentOption.getAttribute('data-type') !== selectedType
            ) {
                categorySelect.value = '';
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCategoryFilter();
        });
    </script>
</x-dashboard-layout>

