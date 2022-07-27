<?php

namespace App\Jobs;

use App\Events\LogMessageReceived;
use App\Models\Account;
use App\Models\Address;
use App\Models\Customer;
use App\Models\InvoiceLine;
use App\Models\Item;
use App\Models\PaymentLine;
use App\Models\Term;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class CleanupQuickbooks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
