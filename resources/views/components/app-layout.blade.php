<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-white">
            @include('layouts.corporate-navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-gray-900 text-white">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">{{ config('app.name', 'Laravel') }}</h3>
                            <p class="text-gray-400">Your trusted partner in personal finance management.</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Quick Links</h4>
                            <ul class="space-y-2">
                                <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Home</a></li>
                                <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white">About</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Account</h4>
                            <ul class="space-y-2">
                                @auth
                                    <li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white">Dashboard</a></li>
                                    <li><a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-white">Profile</a></li>
                                @else
                                    <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white">Login</a></li>
                                    <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white">Register</a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                    <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-400">
                        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>

