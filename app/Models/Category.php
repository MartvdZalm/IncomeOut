<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'color',
        'icon',
        'is_default',
        'order',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'order'      => 'integer',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, Category>
     */
    public static function getDefaults(string $type): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('is_default', true)
            ->where('type', $type)
            ->orderBy('order')
            ->get();
    }

    /**
     * Get categories for a user (including defaults).
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, Category>
     */
    public static function forUser(?int $userId, string $type): \Illuminate\Database\Eloquent\Collection
    {
        return static::where(function ($query) use ($userId, $type) {
            $query->where('type', $type)
                ->where(function ($q) use ($userId) {
                    $q->where('is_default', true)
                        ->orWhere('user_id', $userId);
                });
        })
            ->orderBy('is_default', 'desc')
            ->orderBy('order')
            ->orderBy('name')
            ->get();
    }
}
