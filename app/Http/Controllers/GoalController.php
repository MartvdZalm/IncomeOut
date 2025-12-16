<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Goal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GoalController extends Controller
{
    /**
     * Display a listing of goals and their progress.
     */
    public function index(): string
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $goals = Goal::where('user_id', $user->id)
            ->with(['primaryAccount', 'transactions'])
            ->orderBy('created_at', 'desc')
            ->get();

        $accounts = Account::where('user_id', $user->id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        // Calculate progress based on transactions linked to each goal
        $goalsWithProgress = $goals->map(function (Goal $goal) {
            $contributions = $goal->transactions()
                ->where('transactions.amount', '>', 0)
                ->sum('amount');

            $percentage = $goal->target_amount > 0
                ? min(100, round(($contributions / $goal->target_amount) * 100, 1))
                : 0;

            $goal->setAttribute('progress_amount', $contributions);
            $goal->setAttribute('progress_percentage', (float) $percentage);

            return $goal;
        });

        return view('dashboard.goals.index', [
            'goals'    => $goalsWithProgress,
            'accounts' => $accounts,
        ]);
    }

    /**
     * Store a newly created goal.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'target_amount'      => 'required|numeric|min:0.01',
            'primary_account_id' => 'nullable|exists:accounts,id',
            'due_date'           => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();

        // Ensure primary account belongs to user if provided
        if (! empty($validated['primary_account_id'])) {
            Account::where('id', $validated['primary_account_id'])
                ->where('user_id', auth()->id())
                ->firstOrFail();
        }

        Goal::create($validated);

        return Redirect::route('goals.index')->with('success', 'Goal created successfully!');
    }

    /**
     * Update the specified goal.
     */
    public function update(Request $request, Goal $goal): RedirectResponse
    {
        if ($goal->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'target_amount'      => 'required|numeric|min:0.01',
            'primary_account_id' => 'nullable|exists:accounts,id',
            'due_date'           => 'nullable|date',
        ]);

        if (! empty($validated['primary_account_id'])) {
            Account::where('id', $validated['primary_account_id'])
                ->where('user_id', auth()->id())
                ->firstOrFail();
        }

        $goal->update($validated);

        return Redirect::route('goals.index')->with('success', 'Goal updated successfully!');
    }

    /**
     * Remove the specified goal.
     */
    public function destroy(Goal $goal): RedirectResponse
    {
        if ($goal->user_id !== auth()->id()) {
            abort(403);
        }

        $goal->delete();

        return Redirect::route('goals.index')->with('success', 'Goal deleted successfully!');
    }
}
