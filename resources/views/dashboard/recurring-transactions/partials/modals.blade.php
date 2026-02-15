<!-- Add Recurring Transaction Modal -->
<div id="addRecurringModal"
    class="hidden fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-75 z-50 flex items-center justify-center p-4">
    <div
        class="relative mx-auto p-5 border dark:border-gray-700 w-[400px] shadow-lg rounded-md bg-white dark:bg-gray-800 h-[70vh] overflow-y-auto">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Add Recurring Transaction</h3>
            <form action="{{ route('recurring-transactions.store') }}" method="POST" class="space-y-4">
                @csrf
                <x-form.select id="recurring_type" name="type" label="Type" required>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </x-form.select>
                <x-form.input id="recurring_description" name="description" label="Description" type="text"
                    placeholder="e.g., Salary, Rent" required />
                <x-form.input id="recurring_amount" name="amount" label="Amount" type="number" step="0.01"
                    min="0.01" required />
                <x-form.select id="recurring_account" name="account_id" label="Account (optional)">
                    <option value="">Select Account</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                    @endforeach
                </x-form.select>
                <x-form.select id="recurring_frequency" name="frequency" label="Frequency" required>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="biweekly">Biweekly</option>
                    <option value="monthly" selected>Monthly</option>
                    <option value="yearly">Yearly</option>
                </x-form.select>
                <x-form.input id="recurring_start_date" name="start_date" label="Start Date" type="date"
                    value="{{ date('Y-m-d') }}" required />
                <x-form.input id="recurring_end_date" name="end_date" label="End Date (optional)" type="date" />
                <div id="day_of_month_field" style="display: none">
                    <x-form.input id="recurring_day_of_month" name="day_of_month" label="Day of Month (1-31)"
                        type="number" min="1" max="31" />
                </div>
                <x-form.input id="recurring_category" name="category" label="Category (optional)" type="text" />
                <div class="flex gap-2">
                    <x-primary-button class="flex-1">Create Recurring Transaction</x-primary-button>
                    <button type="button"
                        onclick="document.getElementById('addRecurringModal').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Show day of month field for monthly frequency
    document.getElementById('recurring_frequency')?.addEventListener('change', function() {
        const dayField = document.getElementById('day_of_month_field');
        if (this.value === 'monthly') {
            dayField.style.display = 'block';
        } else {
            dayField.style.display = 'none';
        }
    });
</script>
