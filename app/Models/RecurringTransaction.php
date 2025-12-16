<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecurringTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'account_id',
        'type',
        'description',
        'amount',
        'category',
        'frequency',
        'start_date',
        'end_date',
        'last_processed',
        'is_active',
        'day_of_month',
    ];

    protected $casts = [
        'amount'         => 'decimal:2',
        'start_date'     => 'date',
        'end_date'       => 'date',
        'last_processed' => 'date',
        'is_active'      => 'boolean',
    ];

    /**
     * Get the user that owns the recurring transaction.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the account for the recurring transaction.
     *
     * @return BelongsTo<Account, $this>
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Check if this recurring transaction should be processed today.
     */
    public function shouldProcessToday(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $today = Carbon::today();

        // Check if we're past the end date
        if ($this->end_date && $today->gt($this->end_date)) {
            return false;
        }

        // Check if we've already processed today
        if ($this->last_processed && $this->last_processed->isToday()) {
            return false;
        }

        // Check if we're before the start date
        if ($today->lt($this->start_date)) {
            return false;
        }

        // Check frequency
        switch ($this->frequency) {
            case 'daily':
                return true;

            case 'weekly':
                return $today->dayOfWeek === $this->start_date->dayOfWeek;

            case 'biweekly':
                $weeksSinceStart = $today->diffInWeeks($this->start_date);
                return $weeksSinceStart % 2 === 0 && $today->dayOfWeek === $this->start_date->dayOfWeek;

            case 'monthly':
                $day = $this->day_of_month ?? $this->start_date->day;
                // Handle months with fewer days (e.g., Feb 31 -> Feb 28)
                $lastDayOfMonth = $today->copy()->endOfMonth()->day;
                $processDay     = min($day, $lastDayOfMonth);
                return $today->day === $processDay;

            case 'yearly':
                return $today->month === $this->start_date->month
                       && $today->day === $this->start_date->day;

            default:
                return false;
        }
    }
}
