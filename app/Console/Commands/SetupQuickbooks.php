<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;

class SetupQuickbooks extends Command
{
    use ConfirmableTrait;

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
        if (! $this->confirmToProceed()) {
            return 1;
        }

        $this->newLine();

        $this->components->info("Importing Quickbooks Data");

        $this->components->task("Importing accounts", fn() => $this->callSilent('qb:account:import') == 0);
        $this->components->task("Importing payment terms", fn() => $this->callSilent('qb:term:import') == 0);
        $this->components->task("Importing customers", fn() => $this->callSilent('qb:customer:import') == 0);
        $this->components->task("Importing items", fn() => $this->callSilent('qb:item:import') == 0);
        $this->components->task("Setting company names from FQN", fn() => $this->callSilent('qb:set-company-names-from-fqn') == 0);
        $this->components->task("Importing invoices", fn() => $this->callSilent('qb:invoice:import') == 0);
        $this->components->task("Importing adjustments", fn() => $this->callSilent('qb:adjustment:import') == 0);
        $this->components->task("Importing payments", fn() => $this->callSilent('qb:payment:import') == 0);

        $this->newLine();
    }
}
