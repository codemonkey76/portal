<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteContactController extends Controller
{
    public function store()
    {
        dd(request()->all());
    }
}
