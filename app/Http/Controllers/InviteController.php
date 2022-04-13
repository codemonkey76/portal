<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function invite()
    {
        return view('invite');
    }

    public function process()
    {

    }

    public function accept($token)
    {

    }
}
