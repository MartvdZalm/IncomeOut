<x-ui.simple-modal id="addAccountModal" title="Add New Account">
    <form action="{{ route('accounts.store') }}" method="POST" class="space-y-4">
        @csrf
        <x-form.input id="account_name" name="name" label="Account Name" type="text" placeholder="e.g., Main Checking"
            required />
        <x-form.select id="account_type" name="type" label="Account Type" required>
            <option value="checking">Checking</option>
            <option value="savings">Savings</option>
            <option value="credit_card">Credit Card</option>
            <option value="investment">Investment</option>
            <option value="other">Other</option>
        </x-form.select>
        <x-form.input id="account_balance" name="balance" label="Starting Balance" type="number" step="0.01"
            min="0" value="0" required />
        <x-form.input id="account_color" name="color" label="Color" type="color" class="h-10" value="#3B82F6" />
        <div class="flex gap-2">
            <x-ui.button type="submit" class="flex-1">Create Account</x-ui.button>
            <x-ui.button type="button" variant="secondary"
                onclick="document.getElementById('addAccountModal').classList.add('hidden')">
                Cancel
            </x-ui.button>
        </div>
    </form>
</x-ui.simple-modal>

<x-ui.simple-modal id="editAccountModal" title="Edit Account">
    <form id="editAccountForm" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')
        <input type="hidden" id="edit_account_id" name="account_id" />
        <x-form.input id="edit_account_name" name="name" label="Account Name" type="text" required />
        <x-form.select id="edit_account_type" name="type" label="Account Type" required>
            <option value="checking">Checking</option>
            <option value="savings">Savings</option>
            <option value="credit_card">Credit Card</option>
            <option value="investment">Investment</option>
            <option value="other">Other</option>
        </x-form.select>
        <x-form.input id="edit_account_balance" name="balance" label="Starting Balance" type="number" step="0.01"
            min="0" required />
        <x-form.input id="edit_account_color" name="color" label="Color" type="color" class="h-10" />
        <div class="flex gap-2">
            <x-ui.button type="submit" class="flex-1">Update Account</x-ui.button>
            <x-ui.button type="button" variant="secondary"
                onclick="document.getElementById('editAccountModal').classList.add('hidden')">
                Cancel
            </x-ui.button>
        </div>
    </form>
</x-ui.simple-modal>

<x-ui.simple-modal id="transferModal" title="Transfer Money">
    <form action="{{ route('transactions.transfer') }}" method="POST" class="space-y-4">
        @csrf
        <x-form.select id="transfer_from_account_id" name="from_account_id" label="From Account" required>
            @foreach ($accounts as $account)
                <option value="{{ $account->id }}">{{ $account->name }}</option>
            @endforeach
        </x-form.select>
        <x-form.select id="transfer_to_account_id" name="to_account_id" label="To Account" required>
            @foreach ($accounts as $account)
                <option value="{{ $account->id }}">{{ $account->name }}</option>
            @endforeach
        </x-form.select>
        <x-form.input id="transfer_amount" name="amount" label="Amount" type="number" step="0.01" min="0.01"
            required />
        <x-form.input id="transfer_date" name="date" label="Date" type="date" value="{{ date('Y-m-d') }}"
            required />
        <x-form.input id="transfer_description" name="description" label="Description (optional)" type="text"
            placeholder="e.g., Move to savings" />
        @isset($goals)
            <x-form.select id="transfer_goal_id" name="goal_id" label="Goal (optional)">
                <option value="">No goal</option>
                @foreach ($goals as $goal)
                    <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                @endforeach
            </x-form.select>
        @endisset
        <div class="flex gap-2">
            <x-ui.button type="submit" class="flex-1">Create Transfer</x-ui.button>
            <x-ui.button type="button" variant="secondary"
                onclick="document.getElementById('transferModal').classList.add('hidden')">
                Cancel
            </x-ui.button>
        </div>
    </form>
</x-ui.simple-modal>

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
        if (fromSelect) fromSelect.value = String(fromAccountId);
        modal.classList.remove('hidden');
    }
</script>

