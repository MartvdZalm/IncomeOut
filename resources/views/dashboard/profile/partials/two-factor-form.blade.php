<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Two-Factor Authentication
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Add an extra layer of security to your account by requiring a
            verification code sent to your email when logging in.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.2fa.update') }}" class="mt-6">
        @csrf
        @method('PUT')

        <label class="flex items-center gap-3">
            <input
                type="checkbox"
                name="two_factor_enabled"
                value="1"
                {{ auth()->user()->two_factor_enabled ? 'checked' : '' }}
            />

            <span>
                Enable email-based two-factor authentication
            </span>
        </label>

        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>

            @if (session('status') === '2fa-updated')
                <p class="text-sm text-green-600 mt-2">
                    Two-factor authentication settings updated.
                </p>
            @endif
        </div>
    </form>
</section>
