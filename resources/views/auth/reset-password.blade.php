<x-auth-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}" />

        <!-- Email Address -->
        <div>
            <x-form.input id="email" name="email" label="Email" type="email" :value="old('email', $request->email)" required autofocus
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
            <x-primary-button>Reset Password</x-primary-button>
        </div>
    </form>
</x-auth-layout>
