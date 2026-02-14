<?php

namespace App\Http\Controllers;

class CryptoToolsController extends Controller
{
    /**
     * Display the crypto tools page with calculators.
     */
    public function index(): string
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('dashboard.crypto.tools');
    }
}
