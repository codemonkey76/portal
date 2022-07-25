<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuickbooksController extends Controller
{
    public function utilities()
    {
        if (Gate::denies('quickbooks.utilities')) abort(403);

        return view('quickbooks.utilities');
    }
}
