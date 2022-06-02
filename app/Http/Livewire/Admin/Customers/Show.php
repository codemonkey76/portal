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

    public function print(Transaction $transaction)
    {
        $this->notify('Print');
    }

    public function send(Transaction $transaction)
    {
        $this->notify('Send');
    }

    public function show(Transaction $transaction)
    {
        $this->redirectRoute('invoices.edit', [$transaction]);
    }

    public function copy(Transaction $transaction)
    {
        $this->notify('Copy');
    }

    public function void(Transaction $transaction)
    {
        $this->notify('Void');
    }

    public function delete(Transaction $transaction)
    {
        $this->notify('Delete');
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
