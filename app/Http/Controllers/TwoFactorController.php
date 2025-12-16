<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TwoFactorController extends Controller
{
    public function index()
    {
        if (!session()->has('2fa_user_id')) {
            return redirect('/login');
        }

        return view('auth.2fa');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $user = User::findOrFail(session('2fa_user_id'));

        if (
            Hash::check($request->code, $user->two_factor_code)
            && now()->lessThan($user->two_factor_expires_at)
        ) {
            Auth::login($user);

            $request->session()->forget('2fa_user_id');

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
