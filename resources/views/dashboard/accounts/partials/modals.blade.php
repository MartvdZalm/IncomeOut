<!-- Add Account Modal -->
<div id="addAccountModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Account</h3>
            <form action="{{ route('accounts.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="account_name" value="Account Name" />
                    <x-text-input id="account_name" name="name" type="text" class="mt-1 block w-full" placeholder="e.g., Main Checking" required />
                </div>
                <div>
                    <x-input-label for="account_type" value="Account Type" />
                    <select id="account_type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="checking">Checking</option>
                        <option value="savings">Savings</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="investment">Investment</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <x-input-label for="account_balance" value="Starting Balance" />
                    <x-text-input id="account_balance" name="balance" type="number" step="0.01" min="0" class="mt-1 block w-full" value="0" required />
                </div>
                <div>
                    <x-input-label for="account_color" value="Color" />
                    <x-text-input id="account_color" name="color" type="color" class="mt-1 block w-full h-10" value="#3B82F6" />
                </div>
                <div class="flex gap-2">
                    <x-primary-button class="flex-1">Create Account</x-primary-button>
                    <button type="button" onclick="document.getElementById('addAccountModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Account Modal -->
<div id="editAccountModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Account</h3>
            <form id="editAccountForm" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <input type="hidden" id="edit_account_id" name="account_id">
                <div>
                    <x-input-label for="edit_account_name" value="Account Name" />
                    <x-text-input id="edit_account_name" name="name" type="text" class="mt-1 block w-full" required />
                </div>
                <div>
                    <x-input-label for="edit_account_type" value="Account Type" />
                    <select id="edit_account_type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="checking">Checking</option>
                        <option value="savings">Savings</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="investment">Investment</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <x-input-label for="edit_account_balance" value="Starting Balance" />
                    <x-text-input id="edit_account_balance" name="balance" type="number" step="0.01" min="0" class="mt-1 block w-full" required />
                </div>
                <div>
                    <x-input-label for="edit_account_color" value="Color" />
                    <x-text-input id="edit_account_color" name="color" type="color" class="mt-1 block w-full h-10" />
                </div>
                <div class="flex gap-2">
                    <x-primary-button class="flex-1">Update Account</x-primary-button>
                    <button type="button" onclick="document.getElementById('editAccountModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editAccount(id, name, type, balance, color) {
        document.getElementById('edit_account_id').value = id;
        document.getElementById('edit_account_name').value = name;
        document.getElementById('edit_account_type').value = type;
        document.getElementById('edit_account_balance').value = balance;
        document.getElementById('edit_account_color').value = color;
        document.getElementById('editAccountForm').action = `/accounts/${id}`;
        document.getElementById('editAccountModal').classList.remove('hidden');
    }

    function openTransferModal(fromAccountId) {
        const modal = document.getElementById('transferModal');
        const fromSelect = document.getElementById('transfer_from_account_id');

        if (fromSelect) {
            fromSelect.value = String(fromAccountId);
        }

        modal.classList.remove('hidden');
    }
</script>

<!-- Transfer Modal -->
<div id="transferModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Transfer Money</h3>
            <form action="{{ route('transactions.transfer') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="transfer_from_account_id" value="From Account" />
                    <select id="transfer_from_account_id" name="from_account_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input-label for="transfer_to_account_id" value="To Account" />
                    <select id="transfer_to_account_id" name="to_account_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input-label for="transfer_amount" value="Amount" />
                    <x-text-input id="transfer_amount" name="amount" type="number" step="0.01" min="0.01" class="mt-1 block w-full" required />
                </div>
                <div>
                    <x-input-label for="transfer_date" value="Date" />
                    <x-text-input id="transfer_date" name="date" type="date" class="mt-1 block w-full" value="{{ date('Y-m-d') }}" required />
                </div>
                <div>
                    <x-input-label for="transfer_description" value="Description (optional)" />
                    <x-text-input id="transfer_description" name="description" type="text" class="mt-1 block w-full" placeholder="e.g., Move to savings" />
                </div>
                @isset($goals)
                    <div>
                        <x-input-label for="transfer_goal_id" value="Goal (optional)" />
                        <select id="transfer_goal_id" name="goal_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">No goal</option>
                            @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endisset
                <div class="flex gap-2">
                    <x-primary-button class="flex-1">Create Transfer</x-primary-button>
                    <button type="button" onclick="document.getElementById('transferModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

