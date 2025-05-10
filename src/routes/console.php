<?php

use App\Console\Commands\MarkOverdueLoans;
use App\Console\Commands\MarkWaitingLoans;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(MarkOverdueLoans::class)->daily();
Schedule::command(MarkWaitingLoans::class)->daily();
