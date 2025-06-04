<?php

namespace App\Console\Commands;

use App\Enums\LoanStatusEnum;
use App\Models\Loan;
use Illuminate\Console\Command;

class MarkOverdueLoans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-overdue-loans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark loans as overdue if they are past the expected return date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $overdueLoans = Loan::where('status', LoanStatusEnum::ACTIVE->value)
            ->whereNotNull('return_date')
            ->whereNowOrPast('return_date')
            ->get();

        if ($overdueLoans->isEmpty()) {
            $this->info('No overdue loans found.');
            return;
        }

        foreach ($overdueLoans as $loan) {
            $loan->status = LoanStatusEnum::OVERDUE->value;
            $loan->save();
            $this->info("Loan ID " . $loan->id . " marked as overdue.");
        }

        $this->info("All overdue loans (" . count($overdueLoans) . ") have been updated.");
    }
}
