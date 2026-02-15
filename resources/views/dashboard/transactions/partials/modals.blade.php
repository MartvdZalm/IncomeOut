<!-- Add Transaction Modal -->
<div id="addTransactionModal"
    class="hidden fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-75 overflow-y-auto h-full w-full z-50">
    <div
        class="relative top-20 mx-auto p-5 border border-gray-200 dark:border-gray-700 w-96 shadow-lg rounded-md bg-white dark:bg-gray-800 max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Add Transaction</h3>
            <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
                @csrf
                <x-form.select id="transaction_type" name="type" label="Type" required
                    onchange="updateCategoryOptions()">
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </x-form.select>
                <x-form.input id="transaction_description" name="description" label="Description" type="text"
                    placeholder="e.g., Salary, Groceries" required />
                <x-form.input id="transaction_amount" name="amount" label="Amount" type="number" step="0.01"
                    min="0.01" required />
                <x-form.select id="transaction_account" name="account_id" label="Account (optional)">
                    <option value="">Select Account</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                    @endforeach
                </x-form.select>
                <x-form.input id="transaction_date" name="date" label="Date" type="date"
                    value="{{ date('Y-m-d') }}" required />
                <x-form.select id="transaction_category_id" name="category_id" label="Category (optional)">
                    <option value="">No category</option>
                    @php
                        $incomeCategories = \App\Models\Category::forUser(auth()->id(), 'income');
                        $expenseCategories = \App\Models\Category::forUser(auth()->id(), 'expense');
                    @endphp

                    @foreach ($expenseCategories as $category)
                        <option value="{{ $category->id }}" data-type="expense" data-color="{{ $category->color }}"
                            style="color: {{ $category->color }}">
                            {{ $category->name }}
                        </option>
                    @endforeach

                    @foreach ($incomeCategories as $category)
                        <option value="{{ $category->id }}" data-type="income" data-color="{{ $category->color }}"
                            style="color: {{ $category->color }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-form.select>
                @isset($goals)
                    <x-form.select id="transaction_goal_id" name="goal_id" label="Goal (optional)">
                        <option value="">No goal</option>
                        @foreach ($goals as $goal)
                            <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                        @endforeach
                    </x-form.select>
                @endisset

                <div class="flex gap-2">
                    <x-primary-button class="flex-1">Add Transaction</x-primary-button>
                    <button type="button"
                        onclick="document.getElementById('addTransactionModal').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateCategoryOptions() {
        const typeSelect = document.getElementById('transaction_type');
        const categorySelect = document.getElementById('transaction_category_id');
        const selectedType = typeSelect.value;

        // Show/hide options based on type
        const options = categorySelect.querySelectorAll('option[data-type]');
        options.forEach((option) => {
            if (option.value === '') {
                option.style.display = 'block'; // Always show "No category"
            } else {
                option.style.display = option.getAttribute('data-type') === selectedType ? 'block' : 'none';
            }
        });

        // Reset selection if current selection doesn't match type
        const currentOption = categorySelect.options[categorySelect.selectedIndex];
        if (currentOption.value !== '' && currentOption.getAttribute('data-type') !== selectedType) {
            categorySelect.value = '';
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateCategoryOptions();
    });
</script>
