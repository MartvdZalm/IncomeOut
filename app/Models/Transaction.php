<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'account_id',
        'type',
        'is_transfer',
        'transfer_group_id',
        'description',
        'amount',
        'date',
        'category',
        'category_id',
        'goal_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date'   => 'date',
    ];

    /**
     * Get the user that owns the transaction.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the account for the transaction.
     *
     * @return BelongsTo<Account, $this>
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the goal associated with the transaction, if any.
     *
     * @return BelongsTo<Goal, $this>
     */
    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }

    /**
     * Get the category for this transaction.
     *
     * @return BelongsTo<Category, $this>
     */
    public function categoryRelation(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the category name (from relation or legacy field).
     *
     */
    public function getCategoryNameAttribute(): ?string
    {
        if ($this->categoryRelation) {
            return $this->categoryRelation->name;
        }

        return $this->category;
    }
}
