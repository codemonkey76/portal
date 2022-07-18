<?php

namespace App\Http\Livewire\Admin\InvoiceLines;

use App\Models\InvoiceLine;
use App\Models\Item;
use App\Models\Transaction;
use Livewire\Component;

class Edit extends Component
{
    public Transaction $invoice;

    protected $listeners = ['showEditInvoiceLineModal'];
    public $editing;
    public $showModal = false;
    public $items;

    protected function rules()
    {
        return [
            'editing.item_id' => 'required|exists:items,id',
            'editing.description' => '',
            'editing.qty' => 'required|numeric',
            'editing.unit_price' => 'required|numeric',
            'editing.amount' => 'required|numeric'
        ];
    }
    public function showEditInvoiceLineModal(InvoiceLine $line)
    {
        $this->editing = $line;
        $this->showModal = true;
    }

    public function updatedEditingUnitPrice()
    {
        $this->updateAmount();
    }

    public function updatedEditingQty()
    {
        $this->updateAmount();
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->emitUp('refreshInvoice');
        $this->showModal = false;
    }
    public function updateAmount()
    {
        $this->editing->amount = floatval($this->editing->unit_price) * floatval($this->editing->qty);
    }
    public function mount()
    {
        $this->items = Item::all();
    }
    public function render()
    {
        return view('livewire.admin.invoice-lines.edit');
    }
}
