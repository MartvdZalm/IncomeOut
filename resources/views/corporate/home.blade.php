<x-corporate-layout title="Home">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">Take a Simple Approach to Your Finances</h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto">
                    A free tool I’m building to help you track income, manage expenses, and work towards your financial
                    goals.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 dark:hover:bg-gray-700 transition duration-200">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 dark:hover:bg-gray-700 transition duration-200">
                            Try It Free
                        </a>
                        <a href="{{ route('about') }}"
                            class="bg-blue-700 dark:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-600 dark:hover:bg-blue-500 transition duration-200">
                            Learn More
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    Helpful Features, Without the Complexity
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Tools designed to give you a clear view of your finances without overwhelming you.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="text-center p-6">
                    <div
                        class="bg-blue-100 dark:bg-blue-900 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Track Income & Expenses</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Easily record your income and expenses to see where your money goes.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center p-6">
                    <div
                        class="bg-green-100 dark:bg-green-900 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Set Goals</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Define financial goals, like saving for a small trip or building an emergency fund, and track
                        your progress.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center p-6">
                    <div
                        class="bg-purple-100 dark:bg-purple-900 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Visual Reports</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Simple charts and reports help you understand your spending patterns at a glance.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gray-50 dark:bg-gray-800 py-16">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                Ready to Give It a Try?
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                It's free and still in development, but you can start tracking your finances today and see if it helps.
            </p>

            @auth
                <a href="{{ route('dashboard') }}"
                    class="inline-block bg-blue-600 dark:bg-blue-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 dark:hover:bg-blue-600 transition duration-200">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('register') }}"
                    class="inline-block bg-blue-600 dark:bg-blue-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 dark:hover:bg-blue-600 transition duration-200">
                    Get Started Free
                </a>
            @endauth
        </div>
    </div>
</x-corporate-layout>
