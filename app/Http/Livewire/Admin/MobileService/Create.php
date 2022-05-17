<?php

namespace App\Http\Livewire\Admin\MobileService;

use App\Models\MobileService;
use App\Models\PaymentFrequency;
use App\Models\ServiceAgreement;
use App\Models\ServiceProvider;
use Livewire\Component;

class Create extends Component
{
    public $mobile_service_providers;
    public MobileService $mobile_service;
    public ServiceAgreement $agreement;
    public bool $showModal = false;

    protected $listeners = ['showCreateMobileService' => 'show'];

    public function show()
    {
        $this->showModal = true;
    }

    protected function rules()
    {
        return [
            'mobile_service.mobile_number' => 'required|max:15',
            'mobile_service.service_provider_id' => 'required|in:' . implode(',', ServiceProvider::whereType('mobile')->pluck('id')->toArray()),
            'mobile_service.service_agreement_id' => 'required|in:' . implode(',', ServiceAgreement::pluck('id')->toArray()),
            'mobile_service.price' => 'required|numeric'
        ];
    }

    public function mount()
    {
        $this->mobile_service_providers = ServiceProvider::whereType('mobile')->orderBy('name')->get();

        $this->mobile_service = $this->makeBlankMobileService();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveMobileService()
    {
        $this->validate();

        $this->mobile_service->save();

        $this->emitUp('refreshServiceAgreement');

        $this->showModal = false;
    }

    public function makeBlankMobileService()
    {
        return MobileService::make(['service_agreement_id' => $this->agreement->id]);
    }

    public function render()
    {
        return view('livewire.admin.mobile-service.create');
    }
}
