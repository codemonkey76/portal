<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterSubscriptionController extends Controller
{
    public function store()
    {
        dd(request()->all());
    }
}
