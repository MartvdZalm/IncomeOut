<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @php
                $currencySymbol = currency_symbol();
            @endphp
            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Current Balance Card -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Current Balance</p>
                            <p class="text-3xl font-bold mt-2">{{ format_currency($currentBalance) }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Monthly Income Card -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Monthly Income</p>
                            <p class="text-3xl font-bold mt-2">{{ format_currency($monthlyIncome) }}</p>
                            <p class="text-green-100 text-xs mt-1">{{ now()->format('F Y') }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Monthly Expenses Card -->
                <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-100 text-sm font-medium">Monthly Expenses</p>
                            <p class="text-3xl font-bold mt-2">{{ format_currency($monthlyExpenses) }}</p>
                            <p class="text-red-100 text-xs mt-1">{{ now()->format('F Y') }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="{{ route('transactions.index') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6 hover:shadow-lg transition">
                    <div class="flex items-center">
                        <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-3 mr-4">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100">Transactions</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">View all transactions</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('goals.index') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6 hover:shadow-lg transition">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 dark:bg-yellow-900 rounded-full p-3 mr-4">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100">Goals</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Track your savings goals</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('accounts.index') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6 hover:shadow-lg transition">
                    <div class="flex items-center">
                        <div class="bg-green-100 dark:bg-green-900 rounded-full p-3 mr-4">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100">Accounts</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Manage your accounts</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('recurring-transactions.index') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6 hover:shadow-lg transition">
                    <div class="flex items-center">
                        <div class="bg-purple-100 dark:bg-purple-900 rounded-full p-3 mr-4">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100">Recurring</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Manage recurring transactions</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Charts Filters -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-4">
                <x-date-range-picker
                    id-prefix="dashboard-charts"
                    label="Date range"
                    :show-presets="true"
                />
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                    Filters are applied instantly on the charts without reloading the page.
                </p>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Income vs Expenses Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6">
                    <div class="flex items-baseline justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            Income vs Expenses
                        </h3>
                        <span id="charts-range-label" class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            <!-- Filled by JS -->
                        </span>
                    </div>
                    <div style="height: 300px; position: relative;">
                        <canvas id="incomeExpenseChart"></canvas>
                    </div>
                </div>

                <!-- Monthly Trend Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Monthly Trend
                    </h3>
                    <div style="height: 300px; position: relative;">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Transactions</h3>
                    <a href="{{ route('transactions.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">View All →</a>
                </div>
                
                @if($recentTransactions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Account</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($recentTransactions->take(5) as $transaction)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $transaction->date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($transaction->type === 'income')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                                    Income
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                                    Expense
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $transaction->description }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $transaction->account ? $transaction->account->name : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $transaction->type === 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                            {{ $transaction->type === 'income' ? '+' : '-' }}{{ format_currency($transaction->amount) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this transaction?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No transactions</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by adding your first transaction.</p>
                        <div class="mt-6">
                            <a href="{{ route('transactions.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                                Add Transaction
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const currencySymbol = @json($currencySymbol);

        // Full data from backend (up to last 24 months)
        const fullMonths = @json($chartMonths);
        const fullMonthDates = @json($chartMonthDates); // 'YYYY-MM-DD' for each month start
        const fullIncome = @json($chartIncome);
        const fullExpenses = @json($chartExpenses);

        // Parsed JS Date objects for faster comparisons
        const fullMonthDateObjects = fullMonthDates.map(d => new Date(d + 'T00:00:00'));

        const incomeExpenseCtx = document.getElementById('incomeExpenseChart');
        const trendCtx = document.getElementById('trendChart');
        const rangeLabelEl = document.getElementById('charts-range-label');

        const fromInput = document.getElementById('dashboard-charts-from');
        const toInput = document.getElementById('dashboard-charts-to');
        const presetButtons = document.querySelectorAll('[data-date-range-picker=\"dashboard-charts\"] [data-preset]');

        let incomeChart = null;
        let trendChart = null;

        function formatCurrency(value) {
            return currencySymbol + value.toFixed(2);
        }

        function buildRangeLabel(fromDate, toDate) {
            if (!fromDate || !toDate) {
                return '';
            }
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return fromDate.toLocaleDateString(undefined, options) + ' - ' + toDate.toLocaleDateString(undefined, options);
        }

        function getFilteredIndices(fromDate, toDate) {
            const result = [];
            fullMonthDateObjects.forEach((monthDate, index) => {
                if (fromDate && monthDate < fromDate) return;
                if (toDate && monthDate > toDate) return;
                result.push(index);
            });
            return result;
        }

        function getSliceByIndices(array, indices) {
            return indices.map(i => array[i]);
        }

        function renderCharts(fromDate, toDate) {
            if (!incomeExpenseCtx || !trendCtx) return;

            const indices = getFilteredIndices(fromDate, toDate);
            if (indices.length === 0) {
                // If filter removes everything, fall back to full range
                indices.push(...fullMonths.map((_, i) => i));
            }

            const labels = getSliceByIndices(fullMonths, indices);
            const income = getSliceByIndices(fullIncome, indices);
            const expenses = getSliceByIndices(fullExpenses, indices);
            const netData = income.map((value, idx) => value - expenses[idx]);

            const chartDataBar = {
                labels,
                datasets: [
                    {
                        label: 'Income',
                        data: income,
                        backgroundColor: 'rgba(34, 197, 94, 0.8)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Expenses',
                        data: expenses,
                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 1
                    }
                ]
            };

            const chartDataLine = {
                labels,
                datasets: [
                    {
                        label: 'Net (Income - Expenses)',
                        data: netData,
                        borderColor: 'rgba(59, 130, 246, 1)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }
                ]
            };

            if (!incomeChart) {
                incomeChart = new Chart(incomeExpenseCtx, {
                    type: 'bar',
                    data: chartDataBar,
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        aspectRatio: 2,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + formatCurrency(context.parsed.y);
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return formatCurrency(value);
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                incomeChart.data = chartDataBar;
                incomeChart.update();
            }

            if (!trendChart) {
                trendChart = new Chart(trendCtx, {
                    type: 'line',
                    data: chartDataLine,
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        aspectRatio: 2,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const value = context.parsed.y;
                                        const sign = value >= 0 ? '+' : '';
                                        return 'Net: ' + sign + formatCurrency(Math.abs(value));
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                ticks: {
                                    callback: function(value) {
                                        return formatCurrency(value);
                                    }
                                },
                                grid: {
                                    color: function(context) {
                                        if (context.tick.value === 0) {
                                            return 'rgba(0, 0, 0, 0.5)';
                                        }
                                        return 'rgba(0, 0, 0, 0.1)';
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                trendChart.data = chartDataLine;
                trendChart.update();
            }

            if (rangeLabelEl && fromDate && toDate) {
                rangeLabelEl.textContent = buildRangeLabel(fromDate, toDate);
            } else if (rangeLabelEl) {
                rangeLabelEl.textContent = '';
            }
        }

        function setInputsAndRender(fromDate, toDate) {
            if (fromInput && fromDate) {
                fromInput.valueAsDate = fromDate;
            }
            if (toInput && toDate) {
                toInput.valueAsDate = toDate;
            }
            renderCharts(fromDate, toDate);
        }

        function initDefaultRange() {
            if (fullMonthDateObjects.length === 0) return;

            const lastIndex = fullMonthDateObjects.length - 1;
            const defaultMonths = 6;
            const firstIndex = Math.max(0, fullMonthDateObjects.length - defaultMonths);

            const fromDate = fullMonthDateObjects[firstIndex];
            const toDate = fullMonthDateObjects[lastIndex];

            setInputsAndRender(fromDate, toDate);
        }

        if (fromInput && toInput) {
            fromInput.addEventListener('change', () => {
                const fromDate = fromInput.value ? new Date(fromInput.value + 'T00:00:00') : null;
                const toDate = toInput.value ? new Date(toInput.value + 'T00:00:00') : null;
                renderCharts(fromDate, toDate);
            });

            toInput.addEventListener('change', () => {
                const fromDate = fromInput.value ? new Date(fromInput.value + 'T00:00:00') : null;
                const toDate = toInput.value ? new Date(toInput.value + 'T00:00:00') : null;
                renderCharts(fromDate, toDate);
            });
        }

        presetButtons.forEach(button => {
            button.addEventListener('click', () => {
                const preset = button.getAttribute('data-preset');
                if (!fullMonthDateObjects.length) return;

                const lastIndex = fullMonthDateObjects.length - 1;
                const toDate = fullMonthDateObjects[lastIndex];
                let fromDate = null;

                if (preset === '3m') {
                    fromDate = new Date(toDate);
                    fromDate.setMonth(fromDate.getMonth() - 2);
                } else if (preset === '6m') {
                    fromDate = new Date(toDate);
                    fromDate.setMonth(fromDate.getMonth() - 5);
                } else if (preset === '12m') {
                    fromDate = new Date(toDate);
                    fromDate.setMonth(fromDate.getMonth() - 11);
                } else if (preset === 'ytd') {
                    fromDate = new Date(toDate.getFullYear(), 0, 1);
                }

                setInputsAndRender(fromDate, toDate);
            });
        });

        // Initialize with a sensible default range on load
        initDefaultRange();
    </script>
</x-dashboard-layout>
