<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profile Information</h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-600">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-form.input id="name" name="name" label="Name" type="text" :value="old('name', $user->name)" required autofocus
                autocomplete="name" />
            <x-form.input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-form.input id="email" name="email" label="Email" type="email" :value="old('email', $user->email)" required
                autocomplete="username" />
            <x-form.input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        Your email address is unverified.

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-form.select id="currency" name="currency" label="Currency">
                @php
                    $currentCurrency = old('currency', $user->currency ?? 'USD');
                @endphp

                <option value="USD" {{ $currentCurrency === 'USD' ? 'selected' : '' }}>$ – US Dollar</option>
                <option value="EUR" {{ $currentCurrency === 'EUR' ? 'selected' : '' }}>€ – Euro</option>
                <option value="GBP" {{ $currentCurrency === 'GBP' ? 'selected' : '' }}>£ – British Pound</option>
                <option value="JPY" {{ $currentCurrency === 'JPY' ? 'selected' : '' }}>¥ – Japanese Yen</option>
                <option value="CNY" {{ $currentCurrency === 'CNY' ? 'selected' : '' }}>¥ – Chinese Yuan</option>
            </x-form.select>
            <x-form.input-error class="mt-2" :messages="$errors->get('currency')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => (show = false), 2000)"
                    class="text-sm text-gray-600">
                    Saved.
                </p>
            @endif
        </div>
    </form>
</section>
