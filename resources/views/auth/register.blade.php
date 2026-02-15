<x-auth-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-form.input id="name" name="name" label="Name" type="text" :value="old('name')" required autofocus
                autocomplete="name" />
            <x-form.input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-form.input id="email" name="email" label="Email" type="email" :value="old('email')" required
                autocomplete="username" />
            <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-form.input id="password" name="password" label="Password" type="password" required
                autocomplete="new-password" />
            <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-form.input id="password_confirmation" name="password_confirmation" label="Confirm Password"
                type="password" required autocomplete="new-password" />
            <x-form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                Already registered?
            </a>

            <x-primary-button class="ms-4">Register</x-primary-button>
        </div>
    </form>
</x-auth-layout>
