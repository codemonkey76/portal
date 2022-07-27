<?php

namespace App\Jobs;

use App\Events\LogMessageReceived;
use App\Events\TaskComplete;
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

    public function handle()
    {
        LogMessageReceived::dispatch($this->user, "Deleting transactions...");
        Transaction::all()->each->delete();
        LogMessageReceived::dispatch($this->user, "Done.");

        LogMessageReceived::dispatch($this->user, "Deleting InvoiceLines...");
        InvoiceLine::all()->each->delete();
        LogMessageReceived::dispatch($this->user, "Done.");

        LogMessageReceived::dispatch($this->user, "Deleting PaymentLines...");
        PaymentLine::all()->each->delete();
        LogMessageReceived::dispatch($this->user, "Done.");

        LogMessageReceived::dispatch($this->user, "Deleting Items...");
        Item::all()->each->delete();
        LogMessageReceived::dispatch($this->user, "Done.");

        LogMessageReceived::dispatch($this->user, "Deleting Addresses...");
        Address::all()->each->delete();
        LogMessageReceived::dispatch($this->user, "Done.");

        LogMessageReceived::dispatch($this->user, "Deleting Customers...");
        Customer::all()->each->delete();
        LogMessageReceived::dispatch($this->user, "Done.");

        LogMessageReceived::dispatch($this->user, "Deleting Terms...");
        Term::all()->each->delete();
        LogMessageReceived::dispatch($this->user, "Done.");

        LogMessageReceived::dispatch($this->user, "Deleting Accounts...");
        Account::all()->each->delete();
        LogMessageReceived::dispatch($this->user, "Done.");

        TaskComplete::dispatch($this->user);
        return 0;
    }
}
