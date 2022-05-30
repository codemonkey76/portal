<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Customer;
use App\Models\Invoice;
use Livewire\Component;

class Show extends Component
{
    use WithSearch, WithSorting, WithPerPagePagination;

    public $perPageVariable = "transactionsPerPage";
    public Customer $customer;

    public function getRowsQueryProperty()
    {
        $query = Invoice::query()
                        ->whereCustomerId($this->customer->id)
                        ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function print(Invoice $invoice)
    {
        $this->notify('Print');
    }

    public function send(Invoice $invoice)
    {
        $this->notify('Send');
    }

    public function show(Invoice $invoice)
    {
        $this->notify('Show');
    }

    public function copy(Invoice $invoice)
    {
        $this->notify('Copy');
    }

    public function void(Invoice $invoice)
    {
        $this->notify('Void');
    }

    public function delete(Invoice $invoice)
    {
        $this->notify('Delete');
    }

    public function render()
    {
        return view('livewire.admin.customers.show', ['transactions' => $this->rows]);
    }

}
