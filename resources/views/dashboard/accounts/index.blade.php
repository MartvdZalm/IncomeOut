<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Accounts</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Your Accounts</h3>
                <button onclick="document.getElementById('addAccountModal').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    + Add Account
                </button>
            </div>

            @if($accounts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($accounts as $account)
                        <div class="bg-white rounded-lg shadow-md p-6 border-l-4" style="border-color: {{ $account->color }};">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-xl font-semibold text-gray-900">{{ $account->name }}</h4>
                                    <p class="text-sm text-gray-500 capitalize mt-1">{{ str_replace('_', ' ', $account->type) }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <button onclick="editAccount({{ $account->id }}, '{{ $account->name }}', '{{ $account->type }}', {{ $account->balance }}, '{{ $account->color }}')" class="text-blue-600 hover:text-blue-800 text-sm">Edit</button>
                                    <form action="{{ route('accounts.destroy', $account) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure? This will also delete all transactions for this account.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-gray-500">Current Balance</p>
                                <p class="text-3xl font-bold mt-1" style="color: {{ $account->color }};">${{ number_format($account->calculateBalance(), 2) }}</p>
                                <p class="text-xs text-gray-400 mt-1">Starting: ${{ number_format($account->balance, 2) }}</p>

                                <div class="flex flex-wrap gap-2 mt-4">
                                    <a href="{{ route('transactions.index', ['account_id' => $account->id]) }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                                        View transactions
                                    </a>
                                    <button type="button" onclick="openTransferModal({{ $account->id }})" class="text-green-600 hover:text-green-800 text-xs font-medium">
                                        Transfer money
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No accounts</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating your first account.</p>
                    <div class="mt-6">
                        <button onclick="document.getElementById('addAccountModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            + Add Account
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('dashboard.accounts.partials.modals')
</x-dashboard-layout>


