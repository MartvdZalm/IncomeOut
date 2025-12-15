<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Display a listing of accounts.
     */
    public function index(): View
    {
        $accounts = Account::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('dashboard.accounts.index', [
            'accounts' => $accounts,
        ]);
    }

    /**
     * Store a newly created account.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:checking,savings,credit_card,investment,other',
            'balance' => 'required|numeric|min:0',
            'color' => 'nullable|string|max:7',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['color'] = $validated['color'] ?? '#3B82F6';

        Account::create($validated);

        return Redirect::route('accounts.index')->with('success', 'Account created successfully!');
    }

    /**
     * Update the specified account.
     */
    public function update(Request $request, Account $account)
    {
        // Ensure the account belongs to the authenticated user
        if ($account->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:checking,savings,credit_card,investment,other',
            'balance' => 'required|numeric|min:0',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
        ]);

        $account->update($validated);

        return Redirect::route('accounts.index')->with('success', 'Account updated successfully!');
    }

    /**
     * Remove the specified account.
     */
    public function destroy(Account $account)
    {
        // Ensure the account belongs to the authenticated user
        if ($account->user_id !== auth()->id()) {
            abort(403);
        }

        $account->delete();

        return Redirect::route('accounts.index')->with('success', 'Account deleted successfully!');
    }
}
