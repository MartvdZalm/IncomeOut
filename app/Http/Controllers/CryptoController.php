<?php

namespace App\Http\Controllers;

class CryptoController extends Controller
{
    /**
     * Display the crypto dashboard.
     */
    public function index(): string
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('dashboard.crypto.index');
    }
}
