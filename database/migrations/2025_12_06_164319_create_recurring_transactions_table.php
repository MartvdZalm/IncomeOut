<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recurring_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('account_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('type', ['income', 'expense']);
            $table->string('description');
            $table->decimal('amount', 10, 2);
            $table->string('category')->nullable();
            $table->enum('frequency', ['daily', 'weekly', 'biweekly', 'monthly', 'yearly']);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('last_processed')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('day_of_month')->nullable(); // For monthly: which day (1-31)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_transactions');
    }
};
