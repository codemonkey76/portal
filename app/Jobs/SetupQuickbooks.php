<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SetupQuickbooks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $exitCode = 0;

        $exitCode = Artisan::call('qb:account:import');

        Log::info(Artisan::output());

        if ($exitCode !== 0) return;

        $exitCode = Artisan::call('qb:term:import');

        Log::info(Artisan::output());

        if ($exitCode !== 0) return;

        $exitCode = Artisan::call('qb:customer:import');

        Log::info(Artisan::output());

        if ($exitCode !== 0) return;

        $exitCode = Artisan::call('qb:item:import');

        Log::info(Artisan::output());

        if ($exitCode !== 0) return;

        $exitCode = Artisan::call('qb:set-company-names-from-fqn');

        Log::info(Artisan::output());

        if ($exitCode !== 0) return;

        $exitCode = Artisan::call('qb:invoice:import');

        Log::info(Artisan::output());

        if ($exitCode !== 0) return;

        $exitCode = Artisan::call('qb:adjustment:import');

        Log::info(Artisan::output());

        if ($exitCode !== 0) return;

        Artisan::call('qb:payment:import');

        Log::info(Artisan::output());
    }
}
