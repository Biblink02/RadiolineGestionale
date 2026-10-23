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
    public function handle(): int
    {
        $count = Loan::where('status', LoanStatusEnum::ACTIVE)
            ->whereDate('radio_return_date', '<', today())
            ->update(['status' => LoanStatusEnum::OVERDUE]);

        $this->info("Loans marked as overdue: {$count}.");

        return self::SUCCESS;
    }
}
