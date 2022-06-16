<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Customer::class);
    }

    public function index()
    {
        return view('customers.index');
    }

    public function show(Customer $customer)
    {
        if (Gate::denies('customers.show', $customer)) return "not allowed";


        return view('customers.show', ['customer' => $customer]);
    }
}
