<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;

class SetCompanyNamesFromFqn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qb:set-company-names-from-fqn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set company_name from fully_qualified_name, stripping off the numbers from the prefix';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Customer::setCompanyNamesFromFqn();
        return 0;
    }
}
