<!-- Add Recurring Transaction Modal -->
<div id="addRecurringModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Add Recurring Transaction</h3>
            <form action="{{ route('recurring-transactions.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="recurring_type" value="Type" />
                    <select id="recurring_type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="income">Income</option>
                        <option value="expense">Expense</option>
                    </select>
                </div>
                <div>
                    <x-input-label for="recurring_description" value="Description" />
                    <x-text-input id="recurring_description" name="description" type="text" class="mt-1 block w-full" placeholder="e.g., Salary, Rent" required />
                </div>
                <div>
                    <x-input-label for="recurring_amount" value="Amount" />
                    <x-text-input id="recurring_amount" name="amount" type="number" step="0.01" min="0.01" class="mt-1 block w-full" required />
                </div>
                <div>
                    <x-input-label for="recurring_account" value="Account (optional)" />
                    <select id="recurring_account" name="account_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Account</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input-label for="recurring_frequency" value="Frequency" />
                    <select id="recurring_frequency" name="frequency" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="biweekly">Biweekly</option>
                        <option value="monthly" selected>Monthly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </div>
                <div>
                    <x-input-label for="recurring_start_date" value="Start Date" />
                    <x-text-input id="recurring_start_date" name="start_date" type="date" class="mt-1 block w-full" value="{{ date('Y-m-d') }}" required />
                </div>
                <div>
                    <x-input-label for="recurring_end_date" value="End Date (optional)" />
                    <x-text-input id="recurring_end_date" name="end_date" type="date" class="mt-1 block w-full" />
                </div>
                <div id="day_of_month_field" style="display: none;">
                    <x-input-label for="recurring_day_of_month" value="Day of Month (1-31)" />
                    <x-text-input id="recurring_day_of_month" name="day_of_month" type="number" min="1" max="31" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="recurring_category" value="Category (optional)" />
                    <x-text-input id="recurring_category" name="category" type="text" class="mt-1 block w-full" />
                </div>
                <div class="flex gap-2">
                    <x-primary-button class="flex-1">Create Recurring Transaction</x-primary-button>
                    <button type="button" onclick="document.getElementById('addRecurringModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
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

