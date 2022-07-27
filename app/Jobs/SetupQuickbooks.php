<?php

namespace App\Jobs;

use App\Events\LogMessageReceived;
use App\Events\QuickbooksSetupComplete;
use App\Models\User;
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

    public int $timeout = 360;

    public function __construct(public User $user)
    {}

    private function runCommand(string $command): int
    {
        $exitCode = Artisan::call($command);
        LogMessageReceived::dispatch($this->user, Artisan::output());
        return $exitCode;
    }

    public function handle()
    {
        $exitCode = $this->runCommand('qb:account:import');
        if ($exitCode !== 0) return;

        $exitCode = $this->runCommand('qb:term:import');
        if ($exitCode !== 0) return;

        $exitCode = $this->runCommand('qb:customer:import');
        if ($exitCode !== 0) return;

        $exitCode = $this->runCommand('qb:item:import');
        if ($exitCode !== 0) return;

        $exitCode = $this->runCommand('qb:set-company-names-from-fqn');
        if ($exitCode !== 0) return;

        $exitCode = $this->runCommand('qb:invoice:import');
        if ($exitCode !== 0) return;

        $exitCode = $this->runCommand('qb:adjustment:import');
        if ($exitCode !== 0) return;

        $exitCode = $this->runCommand('qb:payment:import');
        if ($exitCode !== 0) return;

        QuickbooksSetupComplete::dispatch($this->user);
    }
}
