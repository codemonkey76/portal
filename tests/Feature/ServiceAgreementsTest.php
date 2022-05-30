<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\ServiceAgreements\Edit;
use App\Models\Customer;
use App\Models\ServiceAgreement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\RolesAndPermissions;

class ServiceAgreementsTest extends TestCase
{
    use RefreshDatabase, RolesAndPermissions;


    protected function shouldSeed() : bool
    {
        return true;
    }

    public function test_can_visit_edit_route()
    {
        $this->asAdmin();

        $customer = Customer::factory()->create(['company_name' => 'foo']);
        $service_agreement = ServiceAgreement::factory()->create(['customer_id' => $customer->id]);

        $this->get(route('service-agreements.edit', [$service_agreement->id]))->assertSeeLivewire(Edit::class);
    }
    public function test_can_edit_service_agreement()
    {
        $this->asAdmin();


        $customer = Customer::factory()->create(['company_name' => 'foo']);
        $service_agreement = ServiceAgreement::factory()->create(['customer_id' => $customer->id]);

        Livewire::test(Edit::class, ['agreement' => $service_agreement])
                ->assertStatus(200);

        // add a network service
        // add a mobile service
        // add a product
        // send agreement
        // set active
    }
}
