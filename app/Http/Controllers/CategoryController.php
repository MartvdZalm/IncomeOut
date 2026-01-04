<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(): string
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $incomeCategories  = Category::forUser($user->id, 'income');
        $expenseCategories = Category::forUser($user->id, 'expense');

        return view('dashboard.categories.index', [
            'incomeCategories'  => $incomeCategories,
            'expenseCategories' => $expenseCategories,
        ]);
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'type'  => 'required|in:income,expense',
            'color' => 'required|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'icon'  => 'nullable|string|max:255',
        ]);

        $validated['user_id']    = auth()->id();
        $validated['is_default'] = false;

        // Check if category with same name and type already exists for this user
        $existing = Category::where('user_id', auth()->id())
            ->where('name', $validated['name'])
            ->where('type', $validated['type'])
            ->first();

        if ($existing) {
            return Redirect::route('categories.index')
                ->with('error', 'A category with this name and type already exists.');
        }

        Category::create($validated);

        return Redirect::route('categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        if ($category->is_default) {
            return Redirect::route('categories.index')
                ->with('error', 'Default categories cannot be modified.');
        }

        if ($category->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'color' => 'required|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'icon'  => 'nullable|string|max:255',
        ]);

        // Check if another category with same name and type exists for this user
        $existing = Category::where('user_id', auth()->id())
            ->where('name', $validated['name'])
            ->where('type', $category->type)
            ->where('id', '!=', $category->id)
            ->first();

        if ($existing) {
            return Redirect::route('categories.index')
                ->with('error', 'A category with this name and type already exists.');
        }

        $category->update($validated);

        return Redirect::route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $category): RedirectResponse
    {
        if ($category->is_default) {
            return Redirect::route('categories.index')
                ->with('error', 'Default categories cannot be deleted.');
        }

        if ($category->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if category is in use
        if ($category->transactions()->count() > 0) {
            return Redirect::route('categories.index')
                ->with('error', 'Cannot delete category that is being used by transactions.');
        }

        $category->delete();

        return Redirect::route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
