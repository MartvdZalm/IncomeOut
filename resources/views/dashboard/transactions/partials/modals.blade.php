<!-- Add Transaction Modal -->
<div id="addTransactionModal" class="hidden fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-75 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border border-gray-200 dark:border-gray-700 w-96 shadow-lg rounded-md bg-white dark:bg-gray-800 max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Add Transaction</h3>
            <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="transaction_type" value="Type" />
                    <select id="transaction_type" name="type" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400" required>
                        <option value="income">Income</option>
                        <option value="expense">Expense</option>
                    </select>
                </div>
                <div>
                    <x-input-label for="transaction_description" value="Description" />
                    <x-text-input id="transaction_description" name="description" type="text" class="mt-1 block w-full" placeholder="e.g., Salary, Groceries" required />
                </div>
                <div>
                    <x-input-label for="transaction_amount" value="Amount" />
                    <x-text-input id="transaction_amount" name="amount" type="number" step="0.01" min="0.01" class="mt-1 block w-full" required />
                </div>
                <div>
                    <x-input-label for="transaction_account" value="Account (optional)" />
                    <select id="transaction_account" name="account_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                        <option value="">Select Account</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input-label for="transaction_date" value="Date" />
                    <x-text-input id="transaction_date" name="date" type="date" class="mt-1 block w-full" value="{{ date('Y-m-d') }}" required />
                </div>
                <div>
                    <x-input-label for="transaction_category" value="Category (optional)" />
                    <x-text-input id="transaction_category" name="category" type="text" class="mt-1 block w-full" />
                </div>
                @isset($goals)
                    <div>
                        <x-input-label for="transaction_goal_id" value="Goal (optional)" />
                        <select id="transaction_goal_id" name="goal_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                            <option value="">No goal</option>
                            @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endisset
                <div class="flex gap-2">
                    <x-primary-button class="flex-1">Add Transaction</x-primary-button>
                    <button type="button" onclick="document.getElementById('addTransactionModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

