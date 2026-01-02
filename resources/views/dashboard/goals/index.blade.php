<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Goals</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Your Goals</h3>
            </div>

            <div class="bg-white dark:bg-gray-800 dark:shadow-gray-700 rounded-lg shadow-md p-6">
                <h4 class="text-md font-semibold text-gray-900 mb-4 dark:text-gray-100">Add New Goal</h4>
                <form action="{{ route('goals.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    @csrf
                    <div>
                        <x-input-label for="goal_name" value="Name" />
                        <x-text-input id="goal_name" name="name" type="text" class="mt-1 block w-full" required />
                    </div>
                    <div>
                        <x-input-label for="goal_target_amount" value="Target Amount" />
                        <x-text-input id="goal_target_amount" name="target_amount" type="number" step="0.01" min="0.01" class="mt-1 block w-full" required />
                    </div>
                    <div>
                        <x-input-label for="goal_primary_account_id" value="Primary Account (optional)" />
                        <select id="goal_primary_account_id" name="primary_account_id" class="mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white border-gray-300 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                            <option value="">Any Account</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="goal_due_date" value="Due Date (optional)" />
                        <x-text-input id="goal_due_date" name="due_date" type="date" class="mt-1 block w-full" />
                    </div>
                    <div class="md:col-span-4 flex justify-end mt-2">
                        <x-primary-button>Create Goal</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 dark:shadow-gray-700 rounded-lg shadow-md p-6">
                @if($goals->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($goals as $goal)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-5 flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $goal->name }}
                                            </h4>

                                            @if($goal->primaryAccount)
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                    Primary account: {{ $goal->primaryAccount->name }}
                                                </p>
                                            @endif

                                            @if($goal->due_date)
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                    Due: {{ $goal->due_date->format('M d, Y') }}
                                                </p>
                                            @endif
                                        </div>

                                        <form action="{{ route('goals.destroy', $goal) }}" method="POST"
                                              onsubmit="return confirm('Delete this goal? This will not delete any transactions.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-xs">
                                                Delete
                                            </button>
                                        </form>
                                    </div>

                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                                        <span class="font-semibold">
                                            ${{ number_format($goal->progress_amount, 2) }}
                                        </span>
                                        of
                                        <span class="font-semibold">
                                            ${{ number_format($goal->target_amount, 2) }}
                                        </span>
                                    </p>

                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                        <div class="bg-green-500 h-2.5 rounded-full"
                                             style="width: {{ $goal->progress_percentage }}%">
                                        </div>
                                    </div>

                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                        {{ $goal->progress_percentage }}% complete
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <h4 class="text-md font-medium text-gray-900">No goals yet</h4>
                        <p class="text-sm text-gray-500 mt-1">Create a goal above to start tracking your savings progress.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-dashboard-layout>


