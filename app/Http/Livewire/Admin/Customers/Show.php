<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Customer;
use App\Models\Transaction;
use Livewire\Component;

class Show extends Component
{
    use WithSearch, WithSorting, WithPerPagePagination;

    public $perPageVariable = "transactionsPerPage";
    public Customer $customer;
    public Transaction $editing;

    public function getRowsQueryProperty()
    {
        $query = Transaction::query()
                        ->whereCustomerId($this->customer->id)
                        ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function send(Transaction $transaction)
    {
        $this->notImplemented();
    }
    public function notImplemented()
    {
        $this->notify('Not yet implemented');
    }

    public function view(Transaction $transaction)
    {
        $this->redirectRoute('invoices.show', [$transaction]);
    }

    public function edit(Transaction $transaction)
    {
        switch($transaction->type)
        {
            case "invoice":
                $this->redirectRoute('invoices.edit', [$transaction]);
                break;
            case "payment":
                $this->redirectRoute('payments.edit', [$transaction]);
        }
    }

    public function copy(Transaction $transaction)
    {
        $this->notImplemented();
    }

    public function void(Transaction $transaction)
    {
        $this->notImplemented();
    }

    public function delete(Transaction $transaction)
    {
        $this->notImplemented();
    }

    public function mount()
    {
        $this->sorts['transaction_date'] = 'desc';
        $this->transaction = Transaction::make();
    }

    public function render()
    {
        return view('livewire.admin.customers.show', ['transactions' => $this->rows]);
    }

}
