<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property float $progress_amount
 * @property float $progress_percentage
 */
class Goal extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'target_amount',
        'primary_account_id',
        'due_date',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'due_date'      => 'date',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Account, $this>
     */
    public function primaryAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'primary_account_id');
    }

    /**
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
