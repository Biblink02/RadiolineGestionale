<?php

namespace App\Console\Commands;

use App\Enums\LoanStatusEnum;
use App\Models\Loan;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

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
    public function handle()
    {
        // Imposta la data odierna
        $today = Carbon::today();

        // Recupera i prestiti con status 'scheduled' e loan_date uguale a oggi
        $scheduledLoans = Loan::where('status', LoanStatusEnum::SCHEDULED)
            ->whereDate('loan_date', $today)
            ->get();

        // Aggiorna ogni prestito a 'active'
        foreach ($scheduledLoans as $loan) {
            $loan->status = LoanStatusEnum::WAITING;
            $loan->save();
            $this->info("Loan ID " . $loan->id . " marked as SCHEDULED.");
        }

        // Mostra un messaggio di conferma in console
        $this->info("Scheduled loans due today (" . $scheduledLoans->count() . ") set to 'WAITING'.");
    }
}
