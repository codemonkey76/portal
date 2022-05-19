<?php

namespace App\Http\Livewire\Admin\ServiceAgreements;

use App\Models\NetworkService;
use App\Models\ServiceAgreement;
use App\Notifications\ServiceAgreementProposal;
use Livewire\Component;

class Edit extends Component
{
    public ServiceAgreement $agreement;

    public NetworkService $network;

    public array $network_speeds = [];
    public array $service_types = [];
    public array $carriers = [];

    public $service_type;

    protected $listeners = ['refreshServiceAgreement' => 'refresh'];

    public function refresh()
    {
        $this->emit('refreshNetworkServices');
        $this->emit('refreshMobileServices');
        $this->emit('refreshProducts');
        $this->emit('$refresh');
    }
    public function addService()
    {
        switch($this->service_type)
        {
            case "mobile":
                $this->emit('showCreateMobileService');
                break;
            case "network":
                $this->emit('showCreateNetworkService');
                break;
        }
    }

    public function addProduct()
    {
        $this->emit('showAddProduct');
    }

    public function sendAgreement()
    {
        $this->agreement->notify(new ServiceAgreementProposal);
    }

    public function render()
    {
        return view('livewire.admin.service-agreements.edit');
    }
}
