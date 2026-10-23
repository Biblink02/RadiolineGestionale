<?php

namespace App\Console\Commands;

use App\Enums\LoanStatusEnum;
use App\Models\Loan;
use Illuminate\Console\Command;

class MarkWaitingLoans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-waiting-loans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark scheduled loans as waiting if their loan date is today';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $count = Loan::where('status', LoanStatusEnum::SCHEDULED)
            ->whereDate('delivery_date', '<=', today())
            ->update(['status' => LoanStatusEnum::WAITING]);

        $this->info("Loans marked as waiting: {$count}.");

        return self::SUCCESS;
    }
}
