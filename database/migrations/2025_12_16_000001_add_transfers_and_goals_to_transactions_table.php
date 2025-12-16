<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Flag to mark internal transfers so we can exclude them from income/expense stats
            $table->boolean('is_transfer')->default(false)->after('type');

            // Group identifier so both sides of a transfer can be treated as one logical operation
            $table->string('transfer_group_id')->nullable()->after('account_id');

            // Optional link to a savings / budgeting goal
            $table->foreignId('goal_id')
                ->nullable()
                ->after('category')
                ->constrained()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['goal_id']);
            $table->dropColumn(['is_transfer', 'transfer_group_id', 'goal_id']);
        });
    }
};


