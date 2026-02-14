<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Transactions</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">All Transactions</h3>
                <div class="flex gap-2">
                    <button onclick="document.getElementById('addTransactionModal').classList.remove('hidden')"
                        class="bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        + Add Transaction
                    </button>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-4">
                <form method="GET" action="{{ route('transactions.index') }}" class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <x-input-label for="filter_search" value="Search" />
                        <input type="text" id="filter_search" name="search" value="{{ $searchTerm ?? '' }}"
                            placeholder="Search by description..."
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400" />
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <x-input-label for="filter_account" value="Account" />
                        <select id="filter_account" name="account_id"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                            <option value="">All Accounts</option>
                            @foreach ($accounts as $account)
                                <option value="{{ $account->id }}"
                                    {{ $selectedAccount == $account->id ? 'selected' : '' }}>
                                    {{ $account->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <x-input-label for="filter_type" value="Type" />
                        <select id="filter_type" name="type"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                            onchange="updateCategoryFilter()">
                            <option value="">All Types</option>
                            <option value="income" {{ $selectedType == 'income' ? 'selected' : '' }}>Income</option>
                            <option value="expense" {{ $selectedType == 'expense' ? 'selected' : '' }}>Expense</option>
                        </select>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <x-input-label for="filter_category" value="Category" />
                        <select id="filter_category" name="category_id"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                            <option value="">All Categories</option>
                            @foreach ($categories ?? [] as $category)
                                <option value="{{ $category->id }}" data-type="{{ $category->type }}"
                                    {{ ($selectedCategory ?? '') == $category->id ? 'selected' : '' }}
                                    style="color: {{ $category->color }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <x-primary-button>Filter</x-primary-button>
                        <a href="{{ route('transactions.index') }}"
                            class="ml-2 px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500 text-sm">
                            Clear
                        </a>
                    </div>
                </form>
            </div>

            <!-- Transactions Table -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 overflow-hidden">
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
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
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
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $transaction->description }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
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
                                            <form action="{{ route('transactions.destroy', $transaction) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                                    onclick="
                                                        return confirm(
                                                            'Are you sure you want to delete this transaction?',
                                                        );
                                                    ">
                                                    Delete
                                                </button>
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
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No transactions</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Get started by adding your first transaction.
                        </p>
                        <div class="mt-6">
                            <button onclick="document.getElementById('addTransactionModal').classList.remove('hidden')"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                                Add Transaction
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

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
