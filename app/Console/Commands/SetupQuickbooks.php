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
        $this->call('qb:account:import');
        $this->call('qb:term:import');
        $this->call('qb:customer:import');
        $this->call('qb:item:import');
        $this->call('qb:set-company-names-from-fqn');
        $this->call('qb:invoice:import');
        $this->call('qb:adjustment:import');
        $this->call('qb:payment:import');
        return 0;
    }
}
