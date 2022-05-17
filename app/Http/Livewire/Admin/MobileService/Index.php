<?php

namespace App\Http\Livewire\Admin\MobileService;

use App\Models\MobileService;
use App\Models\ServiceAgreement;
use Livewire\Component;

class Index extends Component
{
    public ServiceAgreement $agreement;

    protected $listeners = ['refreshMobileServices' => '$refresh'];

    public function delete(MobileService $mobileService)
    {
        $mobileService->delete();

        $this->emitUp('refreshServiceAgreement');
    }

    public function render()
    {
        return view('livewire.admin.mobile-service.index');
    }
}
