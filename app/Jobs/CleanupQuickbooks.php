<?php

namespace App\Jobs;

use App\Events\LogMessageReceived;
use App\Events\TaskComplete;
use App\Models\Account;
use App\Models\Address;
use App\Models\Customer;
use App\Models\GlobalSetting;
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
        GlobalSetting::whereKey('global_task_in_progress')->first()->update(['value' => 'true']);

        $this->user->logMessage("Deleting transactions...");
        Transaction::all()->each->delete();
        $this->user->logMessage("Done.");

        $this->user->logMessage("Deleting InvoiceLines...");
        InvoiceLine::all()->each->delete();
        $this->user->logMessage("Done.");

        $this->user->logMessage("Deleting PaymentLines...");
        PaymentLine::all()->each->delete();
        $this->user->logMessage("Done.");

        $this->user->logMessage("Deleting Items...");
        Item::all()->each->delete();
        $this->user->logMessage("Done.");

        $this->user->logMessage("Deleting Addresses...");
        Address::all()->each->delete();
        $this->user->logMessage("Done.");

        $this->user->logMessage("Deleting Customers...");
        Customer::all()->each->delete();
        $this->user->logMessage("Done.");

        $this->user->logMessage("Deleting Terms...");
        Term::all()->each->delete();
        $this->user->logMessage("Done.");

        $this->user->logMessage("Deleting Accounts...");
        Account::all()->each->delete();
        $this->user->logMessage("Done.");

        GlobalSetting::whereKey('global_task_in_progress')->first()->update(['value' => 'false']);
        TaskComplete::dispatch($this->user);
        return 0;
    }
}
