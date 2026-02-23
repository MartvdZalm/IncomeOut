<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Accounts</h2>
    </x-slot>

    <x-ui.page-container>
        <x-ui.session-alert type="success" />

        <x-ui.section-header title="Your Accounts">
            <x-slot name="action">
                <x-ui.button type="button" onclick="document.getElementById('addAccountModal').classList.remove('hidden')">
                    + Add Account
                </x-ui.button>
            </x-slot>
        </x-ui.section-header>

        @if ($accounts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($accounts as $account)
                    <x-ui.card class="p-6 border-l-4 transition" :style="'border-left-color: ' . $account->color">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $account->name }}
                                </h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 capitalize mt-1">
                                    {{ str_replace('_', ' ', $account->type) }}
                                </p>
                            </div>
                            <div class="flex gap-2">
                                <x-ui.button type="button" variant="link-primary"
                                    onclick="editAccount({{ $account->id }}, '{{ addslashes($account->name) }}', '{{ $account->type }}', {{ $account->balance }}, '{{ $account->color }}')">
                                    Edit
                                </x-ui.button>
                                <form action="{{ route('accounts.destroy', $account) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure? This will also delete all transactions for this account.');">
                                    @csrf
                                    @method('DELETE')
                                    <x-ui.button type="submit" variant="link-danger">Delete</x-ui.button>
                                </form>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Current Balance</p>
                            <p class="text-3xl font-bold mt-1" style="color: {{ $account->color }}">
                                ${{ number_format($account->calculateBalance(), 2) }}
                            </p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                Starting: ${{ number_format($account->balance, 2) }}
                            </p>
                            <div class="flex flex-wrap gap-2 mt-4">
                                <x-ui.action-link :href="route('transactions.index', ['account_id' => $account->id])" variant="primary">
                                    View transactions
                                </x-ui.action-link>
                                <button type="button" onclick="openTransferModal({{ $account->id }})"
                                    class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 text-xs font-medium">
                                    Transfer money
                                </button>
                            </div>
                        </div>
                    </x-ui.card>
                @endforeach
            </div>
        @else
            <x-ui.empty-state title="No accounts" description="Get started by creating your first account.">
                <x-slot name="icon">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </x-slot>
                <x-slot name="action">
                    <x-ui.button type="button" onclick="document.getElementById('addAccountModal').classList.remove('hidden')">
                        + Add Account
                    </x-ui.button>
                </x-slot>
            </x-ui.empty-state>
        @endif
    </x-ui.page-container>

    @include('dashboard.accounts.partials.modals')
</x-dashboard-layout>
