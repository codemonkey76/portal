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
        Transaction::all()->each->delete();
        InvoiceLine::all()->each->delete();
        PaymentLine::all()->each->delete();
        Item::all()->each->delete();
        Address::all()->each->delete();
        Customer::all()->each->delete();
        Term::all()->each->delete();
        Account::all()->each->delete();
        return 0;
    }
}
