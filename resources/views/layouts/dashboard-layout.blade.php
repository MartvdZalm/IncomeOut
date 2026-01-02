<x-app-layout :title="$title ?? 'Dashboard'" class="bg-gray-100 dark:bg-gray-900">
    <x-navigation.auth-navbar />

    @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow transition-colors duration-200">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main>
        {{ $slot }}
    </main>
</x-app-layout>
