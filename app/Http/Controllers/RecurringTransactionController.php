<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\RecurringTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RecurringTransactionController extends Controller
{
    /**
     * Display a listing of recurring transactions.
     */
    public function index(): View
    {
        $recurringTransactions = RecurringTransaction::where('user_id', auth()->id())
            ->with('account')
            ->orderBy('description')
            ->get();

        $accounts = Account::where('user_id', auth()->id())
            ->where('is_active', true)
            ->get();

        return view('dashboard.recurring-transactions.index', [
            'recurringTransactions' => $recurringTransactions,
            'accounts' => $accounts,
        ]);
    }

    /**
     * Store a newly created recurring transaction.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'nullable|exists:accounts,id',
            'type' => 'required|in:income,expense',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category' => 'nullable|string|max:255',
            'frequency' => 'required|in:daily,weekly,biweekly,monthly,yearly',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'day_of_month' => 'nullable|integer|min:1|max:31',
        ]);

        $validated['user_id'] = auth()->id();

        // Validate account belongs to user
        if ($validated['account_id']) {
            $account = Account::where('id', $validated['account_id'])
                ->where('user_id', auth()->id())
                ->firstOrFail();
        }

        RecurringTransaction::create($validated);

        return Redirect::route('recurring-transactions.index')->with('success', 'Recurring transaction created successfully!');
    }

    /**
     * Update the specified recurring transaction.
     */
    public function update(Request $request, RecurringTransaction $recurringTransaction)
    {
        // Ensure the recurring transaction belongs to the authenticated user
        if ($recurringTransaction->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'account_id' => 'nullable|exists:accounts,id',
            'type' => 'required|in:income,expense',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category' => 'nullable|string|max:255',
            'frequency' => 'required|in:daily,weekly,biweekly,monthly,yearly',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'day_of_month' => 'nullable|integer|min:1|max:31',
            'is_active' => 'boolean',
        ]);

        $recurringTransaction->update($validated);

        return Redirect::route('recurring-transactions.index')->with('success', 'Recurring transaction updated successfully!');
    }

    /**
     * Remove the specified recurring transaction.
     */
    public function destroy(RecurringTransaction $recurringTransaction)
    {
        // Ensure the recurring transaction belongs to the authenticated user
        if ($recurringTransaction->user_id !== auth()->id()) {
            abort(403);
        }

        $recurringTransaction->delete();

        return Redirect::route('recurring-transactions.index')->with('success', 'Recurring transaction deleted successfully!');
    }
}
