<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupQuickbooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qb:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import everything required from quickbooks';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $exitCode = 0;

        $exitCode = $this->call('qb:account:import');

        if ($exitCode !== 0) return $exitCode;

        $exitCode = $this->call('qb:term:import');

        if ($exitCode !== 0) return $exitCode;

        $exitCode = $this->call('qb:customer:import');

        if ($exitCode !== 0) return $exitCode;

        $exitCode = $this->call('qb:item:import');

        if ($exitCode !== 0) return $exitCode;

        $exitCode = $this->call('qb:set-company-names-from-fqn');

        if ($exitCode !== 0) return $exitCode;

        $exitCode = $this->call('qb:invoice:import');

        if ($exitCode !== 0) return $exitCode;

        $exitCode = $this->call('qb:adjustment:import');

        if ($exitCode !== 0) return $exitCode;

        return $this->call('qb:payment:import');
    }
}
