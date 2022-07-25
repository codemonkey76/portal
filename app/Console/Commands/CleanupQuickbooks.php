<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Address;
use App\Models\Customer;
use App\Models\InvoiceLine;
use App\Models\Item;
use App\Models\PaymentLine;
use App\Models\Term;
use App\Models\Transaction;
use Illuminate\Console\Command;

class CleanupQuickbooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qb:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all quickbooks data from local DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Deleting transactions...");
        Transaction::all()->each->delete();
        $this->info("Done.");

        $this->info("Deleting InvoiceLines...");
        InvoiceLine::all()->each->delete();
        $this->info("Done.");

        $this->info("Deleting PaymentLines...");
        PaymentLine::all()->each->delete();
        $this->info("Done.");

        $this->info("Deleting Items...");
        Item::all()->each->delete();
        $this->info("Done.");

        $this->info("Deleting Addresses...");
        Address::all()->each->delete();
        $this->info("Done.");

        $this->info("Deleting Customers...");
        Customer::all()->each->delete();
        $this->info("Done.");

        $this->info("Deleting Terms...");
        Term::all()->each->delete();
        $this->info("Done.");

        $this->info("Deleting Accounts...");
        Account::all()->each->delete();
        $this->info("Done.");

        $this->info("Cleanup Complete.");
        return 0;
    }
}
