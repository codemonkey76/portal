<?php

namespace App\Http\Livewire\Admin\NetworkService;

use App\Models\NetworkCarrier;
use App\Models\NetworkService;
use App\Models\NetworkSpeed;
use App\Models\PaymentFrequency;
use App\Models\ServiceAgreement;
use App\Models\ServiceType;
use Livewire\Component;

class Create extends Component
{
    public ServiceAgreement $agreement;

    public NetworkService $network;

    public $network_speeds = [];
    public $service_types = [];
    public $carriers;
    public $frequencies;
    public $showModal = false;

    protected $listeners = ['showCreateNetworkService' => 'show'];

    public function show()
    {
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->network->save();

        $this->emitUp('networkServiceCreated');

        $this->showModal = false;
    }

    public function makeBlankNetworkService()
    {
        return NetworkService::make([
            'service_agreement_id' => $this->agreement->id,
            'carrier' => 'Superloop',
            'service_type' => 'NBN',
            'speed' => '50Mbps/20Mbps',
            'frequency' => 12
        ]);
    }

    protected array $rules = [
        'network.service_agreement_id' => 'required',
        'network.description' => 'required',
        'network.speed' => '',
        'network.service_id' => '',
        'network.service_type' => '',
        'network.carrier' => '',
        'network.username' => '',
        'network.password' => '',
        'network.ip_address' => '',
        'network.end_user' => '',
        'network.site_name' => '',
        'network.site_address' => '',
        'network.price' => 'required|numeric',
        'network.frequency' => 'required'
    ];

    public function mount()
    {
        $this->service_types = ServiceType::pluck('name')->toArray();
        $this->carriers = NetworkCarrier::pluck('name')->toArray();
        $this->network = $this->makeBlankNetworkService();
        $this->frequencies = PaymentFrequency::all();
        $this->network_speeds = ServiceType::whereName($this->network->service_type)->first()->speeds;
        info($this->network->carrier);
        info(ServiceType::whereName($this->network->service_type)->first()->speeds);
    }

    public function updatedNetworkServiceType()
    {
        $this->network_speeds = ServiceType::whereName($this->network->service_type)->first()->speeds;
    }

    public function updatedNetworkSpeed()
    {
        $this->network->price = NetworkSpeed::find($this->network->speed)->priceString;
    }


    public function render()
    {
        return view('livewire.admin.network-service.create');
    }
}
