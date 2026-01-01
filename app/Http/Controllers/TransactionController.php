<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Goal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions.
     */
    public function index(Request $request): string
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

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

        // Filter by search term if provided
        if ($request->has('search') && $request->search) {
            $query->where('description', 'ilike', "%{$request->search}%");
        }

        $transactions = $query->paginate(20)->withQueryString();
        $accounts     = Account::where('user_id', $user->id)->where('is_active', true)->get();
        $goals        = Goal::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('dashboard.transactions.index', [
            'transactions'    => $transactions,
            'accounts'        => $accounts,
            'goals'           => $goals,
            'selectedAccount' => $request->account_id,
            'selectedType'    => $request->type,
            'searchTerm'      => $request->search,
        ]);
    }

    /**
     * Store a newly created transaction.
     */
    public function store(Request $request): string
    {
        $user = auth()->user();

        // Check if the user is authenticated
        if (!$user) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'account_id'  => 'nullable|exists:accounts,id',
            'type'        => 'required|in:income,expense',
            'description' => 'required|string|max:255',
            'amount'      => 'required|numeric|min:0.01',
            'date'        => 'required|date',
            'category'    => 'nullable|string|max:255',
            'goal_id'     => 'nullable|exists:goals,id',
        ]);

        $validated['user_id'] = $user->id;

        // Validate account belongs to user if provided
        if (! empty($validated['account_id'])) {
            Account::where('id', $validated['account_id'])
                ->where('user_id', $user->id)
                ->firstOrFail();
        }

        // Validate goal belongs to user if provided
        if (! empty($validated['goal_id'])) {
            Goal::where('id', $validated['goal_id'])
                ->where('user_id', $user->id)
                ->firstOrFail();
        }

        Transaction::create($validated);

        return Redirect::route('transactions.index')->with('success', 'Transaction added successfully!');
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy(Transaction $transaction): string
    {
        // Ensure the transaction belongs to the authenticated user
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->delete();

        return Redirect::route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }

    /**
     * Create an internal transfer between two accounts in a single step.
     */
    public function transfer(Request $request): string
    {
        $userId = auth()->id();

        $validated = $request->validate([
            'from_account_id' => 'required|different:to_account_id|exists:accounts,id',
            'to_account_id'   => 'required|exists:accounts,id',
            'amount'          => 'required|numeric|min:0.01',
            'date'            => 'required|date',
            'description'     => 'nullable|string|max:255',
            'goal_id'         => 'nullable|exists:goals,id',
        ]);

        // Ensure both accounts belong to the authenticated user
        $fromAccount = Account::where('id', $validated['from_account_id'])
            ->where('user_id', $userId)
            ->firstOrFail();

        $toAccount = Account::where('id', $validated['to_account_id'])
            ->where('user_id', $userId)
            ->firstOrFail();

        if (! empty($validated['goal_id'])) {
            Goal::where('id', $validated['goal_id'])
                ->where('user_id', $userId)
                ->firstOrFail();
        }

        $groupId = (string) \Illuminate\Support\Str::uuid();

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $userId, $groupId, $fromAccount, $toAccount) {
            // Money leaves the "from" account (behaves like an expense for that account)
            Transaction::create([
                'user_id'           => $userId,
                'account_id'        => $fromAccount->id,
                'type'              => 'expense',
                'is_transfer'       => true,
                'transfer_group_id' => $groupId,
                'description'       => $validated['description'] ?? 'Transfer to ' . $toAccount->name,
                'amount'            => $validated['amount'],
                'date'              => $validated['date'],
                'category'          => 'Transfer',
            ]);

            // Money enters the "to" account (behaves like income for that account)
            Transaction::create([
                'user_id'           => $userId,
                'account_id'        => $toAccount->id,
                'type'              => 'income',
                'is_transfer'       => true,
                'transfer_group_id' => $groupId,
                'description'       => $validated['description'] ?? 'Transfer from ' . $fromAccount->name,
                'amount'            => $validated['amount'],
                'date'              => $validated['date'],
                'category'          => 'Transfer',
                'goal_id'           => $validated['goal_id'] ?? null,
            ]);
        });

        return Redirect::back()->with('success', 'Transfer created successfully!');
    }
}
