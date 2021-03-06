<?php

namespace App\Http\Controllers;

use App\Models\ServiceAgreement;

class ServiceAgreementController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ServiceAgreement::class, 'service_agreement');
    }

    public function index()
    {
        return view('service_agreements.index');
    }

    public function create()
    {
        return view('service_agreements.create');
    }

    public function show(ServiceAgreement $serviceAgreement)
    {
        $serviceAgreement->load(['networkServices', 'mobileServices', 'voipServices', 'customer']);
        return view('service_agreements.show', ['serviceAgreement' => $serviceAgreement]);
    }

    public function edit(ServiceAgreement $serviceAgreement)
    {
        $serviceAgreement->load(['networkServices', 'mobileServices', 'voipServices', 'customer']);
        return view('service_agreements.edit', ['agreement' => $serviceAgreement]);
    }

    public function process()
    {

    }

    public function accept($token)
    {
        return view('service_agreements.accept', ['token' => $token]);
    }
}
