<?php

namespace App\Http\Livewire\Admin\ServiceAgreements;

use App\Models\MobileService;
use App\Models\NetworkCarrier;
use App\Models\NetworkService;
use App\Models\NetworkSpeed;
use App\Models\ServiceAgreement;
use App\Models\ServiceProvider;
use App\Models\ServiceType;
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

    public function render()
    {
        return view('livewire.admin.service-agreements.edit');
    }
}
