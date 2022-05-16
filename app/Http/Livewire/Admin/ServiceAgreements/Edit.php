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

    public $showAddMobileServiceModal = false;
    public $showAddNetworkServiceModal = false;


    public MobileService $mobile_service;
    public NetworkService $network;

    public array $network_speeds = [];
    public array $service_types = [];
    public array $carriers = [];

    public $mobile_service_providers;
    public $network_service_providers;
    public $service_type;

    protected $listeners = ['networkServiceCreated' => '$refresh'];


//    protected function rules(): array
//    {
//        return [
//            'mobile_service.mobile_number' => 'required|max:15',
//            'mobile_service.service_provider_id' => 'required|in:' . implode(',', ServiceProvider::whereType('mobile')->pluck('id')->toArray()),
//            'mobile_service.service_agreement_id' => 'required|in:' . implode(',', ServiceAgreement::pluck('id')->toArray()),
//        ];
//    }

    public function mount()
    {
        $this->mobile_service_providers = ServiceProvider::whereType('mobile')->orderBy('name')->get();

        $this->mobile_service = $this->makeBlankMobileService();

        $this->network_service_providers = ServiceProvider::whereType('network')->orderBy('name')->get();
    }


    public function makeBlankMobileService()
    {
        return MobileService::make(['service_agreement_id' => $this->agreement->id]);
    }

    public function addService()
    {
        switch($this->service_type)
        {
            case "mobile":
                $this->showAddMobileServiceModal = true;
                break;
            case "network":
                $this->emit('showCreateNetworkService');
                break;
        }
    }

    public function saveNetworkService()
    {
        //$this->validate
    }

    public function saveMobileService()
    {
        $this->validate([
            'mobile_service.mobile_number' => 'required|max:15',
            'mobile_service.service_provider_id' => 'required|in:' . implode(',', ServiceProvider::whereType('mobile')->pluck('id')->toArray()),
            'mobile_service.service_agreement_id' => 'required|in:' . implode(',', ServiceAgreement::pluck('id')->toArray())
        ]);

        $this->mobile_service->save();
        $this->showAddMobileServiceModal = false;
        $this->notify('Validated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.service-agreements.edit');
    }
}
