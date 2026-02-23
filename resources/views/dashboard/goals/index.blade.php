<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Goals</h2>
    </x-slot>

    <x-ui.page-container>
        <x-ui.session-alert type="success" />

        <x-ui.section-header title="Your Goals" />

        <x-ui.card class="p-6">
            <h4 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Add New Goal</h4>
            <form action="{{ route('goals.store') }}" method="POST"
                class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                @csrf
                <div>
                    <x-form.input id="goal_name" name="name" label="Name" type="text" required />
                </div>
                <div>
                    <x-form.input id="goal_target_amount" name="target_amount" label="Target Amount" type="number"
                        step="0.01" min="0.01" required />
                </div>
                <div>
                    <x-form.select id="goal_primary_account_id" name="primary_account_id"
                        label="Primary Account (optional)">
                        <option value="">Any Account</option>
                        @foreach ($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </x-form.select>
                </div>
                <div>
                    <x-form.input id="goal_due_date" name="due_date" label="Due Date (optional)" type="date" />
                </div>
                <div class="md:col-span-4 flex justify-end mt-2">
                    <x-ui.button type="submit">Create Goal</x-ui.button>
                </div>
            </form>
        </x-ui.card>

        <x-ui.card class="p-6">
            @if ($goals->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($goals as $goal)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-5 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $goal->name }}
                                        </h4>
                                        @if ($goal->primaryAccount)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                Primary account: {{ $goal->primaryAccount->name }}
                                            </p>
                                        @endif
                                        @if ($goal->due_date)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                Due: {{ $goal->due_date->format('M d, Y') }}
                                            </p>
                                        @endif
                                    </div>
                                    <form action="{{ route('goals.destroy', $goal) }}" method="POST"
                                        onsubmit="return confirm('Delete this goal? This will not delete any transactions.');">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button type="submit" variant="link-danger">Delete</x-ui.button>
                                    </form>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                                    <span class="font-semibold">${{ number_format($goal->progress_amount, 2) }}</span>
                                    of
                                    <span class="font-semibold">${{ number_format($goal->target_amount, 2) }}</span>
                                </p>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                    <div class="bg-green-500 h-2.5 rounded-full"
                                        style="width: {{ $goal->progress_percentage }}%"></div>
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
                    <h4 class="text-md font-medium text-gray-900 dark:text-gray-100">No goals yet</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Create a goal above to start tracking your savings progress.
                    </p>
                </div>
            @endif
        </x-ui.card>
    </x-ui.page-container>
</x-dashboard-layout>
