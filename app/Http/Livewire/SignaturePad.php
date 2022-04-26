<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class SignaturePad extends Component
{
    public $signature;

    public function submit()
    {
        Storage::put('signatures/signature.png', base64_decode(Str::of($this->signature)->after(',')));
    }

    public function clear()
    {
        $this->emit('clear');
        //$this->signature = null;
    }

    public function render()
    {
        return view('livewire.signature-pad');
    }
}
