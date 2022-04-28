<?php

namespace App\Http\Livewire\Admin\ServiceAgreements;

use App\Models\ServiceAgreement;
use Livewire\Component;

class Show extends Component
{
    public ServiceAgreement $serviceAgreement;

    public function render()
    {
        return view('livewire.admin.service-agreements.show');
    }
}
