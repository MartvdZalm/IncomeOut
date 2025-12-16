<?php

use App\Models\User;

if (! function_exists('currency_code')) {
    /**
     * Get the current user's currency code, or a sensible default.
     */
    function currency_code(?User $user = null): string
    {
        $user = $user ?? auth()->user();

        return $user?->currency ?: 'USD';
    }
}

if (! function_exists('currency_symbol')) {
    /**
     * Map a currency code to a symbol (fallback to the code itself).
     */
    function currency_symbol(?string $code = null): string
    {
        $code = $code ?? currency_code();

        $symbols = [
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'JPY' => '¥',
            'CNY' => '¥',
        ];

        return $symbols[$code] ?? $code . ' ';
    }
}

if (! function_exists('format_currency')) {
    /**
     * Format a numeric amount using the current user's currency.
     */
    function format_currency(float|int|string $amount, ?string $code = null): string
    {
        $symbol = currency_symbol($code);

        return $symbol . number_format((float) $amount, 2);
    }
}
