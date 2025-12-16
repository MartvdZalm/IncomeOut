<?php

namespace App\Console\Commands;

use App\Models\RecurringTransaction;
use App\Models\Transaction;
use Illuminate\Console\Command;

class ProcessRecurringTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process recurring transactions and create new transactions';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Processing recurring transactions...');

        $recurringTransactions = RecurringTransaction::where('is_active', true)->get();
        $processed             = 0;

        foreach ($recurringTransactions as $recurring) {
            if ($recurring->shouldProcessToday()) {
                Transaction::create([
                    'user_id'     => $recurring->user_id,
                    'account_id'  => $recurring->account_id,
                    'type'        => $recurring->type,
                    'description' => $recurring->description,
                    'amount'      => $recurring->amount,
                    'date'        => now()->toDateString(),
                    'category'    => $recurring->category,
                ]);

                $recurring->update(['last_processed' => now()]);
                $processed++;

                $this->info("Processed: {$recurring->description} - \${$recurring->amount}");
            }
        }

        $this->info("Processed {$processed} recurring transaction(s).");

        return Command::SUCCESS;
    }
}
