<?php

namespace App\Console;

use App\Console\Commands\MarkOverdueLoans;
use App\Console\Commands\MarkWaitingLoans;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->exec("php artisan app:mark-waiting-loans");
        $schedule->command(MarkOverdueLoans::class)->daily();
        $schedule->command(MarkWaitingLoans::class)->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
