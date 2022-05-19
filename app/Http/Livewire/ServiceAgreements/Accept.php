<?php

namespace App\Http\Livewire\ServiceAgreements;

use App\Models\ServiceAgreement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class Accept extends Component
{
    public $token;

    public ServiceAgreement $agreement;

    public $signature;
    public $name;
    public $position;
    public $date;

    public function rules()
    {
        return [
            'signature' => 'required',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'date' => 'required|date'
        ];
    }

    public function mount()
    {
        $this->agreement = ServiceAgreement::whereToken($this->token)->first();
    }

    public function clearSignature()
    {
        $this->emit('clear');
        $this->signature = null;
    }

    public function render()
    {
        return view('livewire.service-agreements.accept');
    }

    public function signForm()
    {
        $this->validate();

        $signature_path = "signatures/customers/{$this->agreement->id}.png";
        Storage::put($signature_path, base64_decode(Str::of($this->signature)->after(',')));
        $this->agreement->update([
            'signed_by_name' => $this->name,
            'signed_by_position' => $this->position,
            'signed_at' => $this->date,
            'signature_path' => $signature_path,
            'token' => null,
            'expires_at' => null
        ]);

        $this->redirectRoute('home');
    }
}
