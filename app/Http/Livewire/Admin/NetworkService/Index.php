<?php

namespace App\Http\Livewire\Admin\NetworkService;

use App\Models\NetworkService;
use App\Models\ServiceAgreement;
use Livewire\Component;

class Index extends Component
{
    public ServiceAgreement $agreement;

    protected $listeners = ['refreshNetworkServices' => '$refresh'];

    public function delete(NetworkService $networkService)
    {
        $networkService->delete();

        $this->emitUp('refreshServiceAgreement');
    }

    public function render()
    {
        return view('livewire.admin.network-service.index');
    }
}
