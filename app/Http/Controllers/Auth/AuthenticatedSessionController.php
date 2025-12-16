<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\TwoFactorCodeMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->two_factor_enabled) {

            // Log out until 2FA is completed
            Auth::logout();

            // Send 2FA code
            $this->sendTwoFactorCode($user);

            // Store user ID for 2FA verification
            $request->session()->put('2fa_user_id', $user->id);

            return redirect()->route('2fa.index');
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Send the email 2FA code.
     */
    protected function sendTwoFactorCode(User $user): void
    {
        // Do not regenerate if a valid code already exists
        if (
            $user->two_factor_code
            && $user->two_factor_expires_at
            && now()->lessThan($user->two_factor_expires_at)
        ) {
            return;
        }

        $code = random_int(100000, 999999);

        $user->update([
            'two_factor_code'       => Hash::make($code),
            'two_factor_expires_at' => now()->addMinutes(5),
        ]);

        Mail::to($user->email)->send(
            new TwoFactorCodeMail($code)
        );
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
