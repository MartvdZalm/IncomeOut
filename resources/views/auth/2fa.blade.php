<x-auth-layout>
    <form method="POST" action="{{ route('2fa.verify') }}">
        @csrf

        <h2 class="text-lg font-semibold mb-4">Two-Factor Authentication</h2>

        <p class="mb-4">We sent a verification code to your email.</p>

        <x-form.input id="code" name="code" label="Verification Code" type="text" maxlength="6" autofocus />

        <button class="btn-primary w-full">Verify</button>

        @error('code')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror
    </form>
</x-auth-layout>
