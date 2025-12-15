<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions.
     */
    public function index(Request $request): View
    {
        $user = auth()->user();
        
        $query = Transaction::where('user_id', $user->id)
            ->with('account')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        // Filter by account if provided
        if ($request->has('account_id') && $request->account_id) {
            $query->where('account_id', $request->account_id);
        }

        // Filter by type if provided
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        $transactions = $query->paginate(20);
        $accounts = Account::where('user_id', $user->id)->where('is_active', true)->get();

        return view('dashboard.transactions.index', [
            'transactions' => $transactions,
            'accounts' => $accounts,
            'selectedAccount' => $request->account_id,
            'selectedType' => $request->type,
        ]);
    }

    /**
     * Store a newly created transaction.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'nullable|exists:accounts,id',
            'type' => 'required|in:income,expense',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'category' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();

        // Validate account belongs to user if provided
        if ($validated['account_id']) {
            $account = Account::where('id', $validated['account_id'])
                ->where('user_id', auth()->id())
                ->firstOrFail();
        }

        Transaction::create($validated);

        return Redirect::route('transactions.index')->with('success', 'Transaction added successfully!');
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy(Transaction $transaction)
    {
        // Ensure the transaction belongs to the authenticated user
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->delete();

        return Redirect::route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }
}
