<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TwoFactorController extends Controller
{
    public function index(): string
    {
        if (!session()->has('2fa_user_id')) {
            return redirect('/login');
        }

        return view('auth.2fa');
    }

    public function verify(Request $request): string
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect('/login');
        }

        $user = User::where('id', $userId)->firstOrFail();

        if (!$user->two_factor_code || !$user->two_factor_expires_at) {
            return back()->withErrors([
                'code' => 'Invalid or expired code.',
            ]);
        }

        if (Hash::check($request->code, $user->two_factor_code) && now()->lessThan($user->two_factor_expires_at)) { // @phpstan-ignore-line
            Auth::login($user);

            // Clear the session and update user
            $request->session()->forget('2fa_user_id');

            // Reset the two-factor authentication fields
            $user->update([
                'two_factor_code'       => null,
                'two_factor_expires_at' => null,
            ]);

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'code' => 'Invalid or expired code.',
        ]);
    }
}
