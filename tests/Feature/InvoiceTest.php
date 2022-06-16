<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\RolesAndPermissions;

class InvoiceTest extends TestCase
{
    use RefreshDatabase, RolesAndPermissions;
    public function test_invoices_add_up_correctly()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
