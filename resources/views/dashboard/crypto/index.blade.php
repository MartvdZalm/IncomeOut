<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Crypto</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Crypto Dashboard</h3>
            </div>

            <!-- Welcome Card -->
            <div class="bg-gradient-to-br from-orange-500 to-yellow-500 rounded-lg shadow-lg p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Crypto Trading Tools</h3>
                        <p class="text-orange-100 text-lg">Calculate your take profit, stop loss, position sizing, and trading fees</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-6">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Crypto Tools Card -->
                <a href="{{ route('crypto.tools') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6 hover:shadow-lg transition transform hover:scale-105">
                    <div class="flex items-center">
                        <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-4 mr-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-lg">Trading Calculators</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Calculate TP/SL, fees, position sizing, and more</p>
                        </div>
                    </div>
                </a>

                <!-- Coming Soon Cards -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6 opacity-60">
                    <div class="flex items-center">
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-full p-4 mr-4">
                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-lg">Portfolio Tracker</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Coming soon</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6 opacity-60">
                    <div class="flex items-center">
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-full p-4 mr-4">
                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-lg">Price Alerts</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Coming soon</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">About Crypto Tools</h4>
                        <p class="text-sm text-blue-800 dark:text-blue-200">
                            Use the trading calculators to plan your trades effectively. Calculate take profit and stop loss levels based on your desired profit and trading fees, 
                            determine optimal position sizing and understand the impact of fees on your trades.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>

