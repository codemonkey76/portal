<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function __invoke()
    {
        $adminMenu = !!session()->get('preferAdminMenu', false);
        session()->put('preferAdminMenu', !$adminMenu);
        return back();
    }
}
