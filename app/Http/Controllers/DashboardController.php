<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\RecurringTransaction;
use App\Models\Transaction;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(): string
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $currency = $user->currency ?? 'USD';

        // Get current month's date range
        $startOfMonth = now()->startOfMonth();
        $endOfMonth   = now()->endOfMonth();

        // Calculate monthly income
        $monthlyIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        // Calculate monthly expenses
        $monthlyExpenses = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        // Calculate current balance (starting balance + all income - all expenses)
        $totalIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->sum('amount');

        $totalExpenses = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->sum('amount');

        // Get accounts and calculate total balance
        $accounts = Account::where('user_id', $user->id)
            ->where('is_active', true)
            ->with('transactions')
            ->get();

        $totalAccountBalance = $accounts->sum(function ($account) {
            return $account->calculateBalance();
        });

        // Calculate current balance from all accounts
        $currentBalance = $totalAccountBalance;

        // Get recent transactions
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->with('account')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Get recurring transactions
        $recurringTransactions = RecurringTransaction::where('user_id', $user->id)
            ->where('is_active', true)
            ->with('account')
            ->orderBy('description')
            ->get();

        // Get last 6 months data for charts
        $months      = [];
        $incomeData  = [];
        $expenseData = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd   = now()->subMonths($i)->endOfMonth();
            $monthLabel = now()->subMonths($i)->format('M Y');

            $months[]     = $monthLabel;
            $incomeData[] = Transaction::where('user_id', $user->id)
                ->where('type', 'income')
                ->whereBetween('date', [$monthStart, $monthEnd])
                ->sum('amount');
            $expenseData[] = Transaction::where('user_id', $user->id)
                ->where('type', 'expense')
                ->whereBetween('date', [$monthStart, $monthEnd])
                ->sum('amount');
        }

        return view('dashboard.index', [
            'monthlyIncome'         => $monthlyIncome,
            'monthlyExpenses'       => $monthlyExpenses,
            'currentBalance'        => $currentBalance,
            'accounts'              => $accounts,
            'recentTransactions'    => $recentTransactions,
            'recurringTransactions' => $recurringTransactions,
            'chartMonths'           => $months,
            'chartIncome'           => $incomeData,
            'chartExpenses'         => $expenseData,
            'currency'              => $currency,
        ]);
    }
}
