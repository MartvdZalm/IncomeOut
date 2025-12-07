<x-app-layout title="About">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">About Us</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    Learn more about our mission to help you achieve financial freedom.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mission Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                <p class="text-lg text-gray-700 leading-relaxed mb-4">
                    At {{ config('app.name', 'Laravel') }}, we believe that everyone deserves to have control over their financial future. Our mission is to provide you with the tools and insights you need to make informed financial decisions and achieve your goals.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed">
                    We understand that managing personal finances can be overwhelming. That's why we've created an intuitive platform that simplifies the process, making it easy for you to track your income, monitor your expenses, and plan for the future.
                </p>
            </div>

            <!-- Values Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Values</h2>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">User-Centric</h3>
                            <p class="text-gray-700">
                                Your financial success is our top priority. We design every feature with your needs in mind.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Security & Privacy</h3>
                            <p class="text-gray-700">
                                We take your financial data seriously. Your information is encrypted and protected with industry-leading security measures.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Simplicity</h3>
                            <p class="text-gray-700">
                                Financial management shouldn't be complicated. We've built a platform that's powerful yet easy to use.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- What We Offer Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">What We Offer</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Income Tracking</h3>
                        <p class="text-gray-700">
                            Keep track of all your income sources in one place. Categorize and analyze your earnings to better understand your financial flow.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Expense Management</h3>
                        <p class="text-gray-700">
                            Monitor your spending with detailed expense tracking. Identify areas where you can save and optimize your budget.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Financial Goals</h3>
                        <p class="text-gray-700">
                            Set and track your financial goals. Whether it's saving for a house, vacation, or retirement, we help you stay on track.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Insights & Reports</h3>
                        <p class="text-gray-700">
                            Get valuable insights with visual reports and analytics that help you make informed financial decisions.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-blue-50 p-8 rounded-lg text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Ready to Start Your Financial Journey?</h2>
                <p class="text-gray-700 mb-6">
                    Join us today and take the first step towards financial freedom.
                </p>
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Get Started Free
                    </a>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>

