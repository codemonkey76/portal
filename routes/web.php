<?php

use App\Http\Controllers\InviteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::middleware(['can:list users'])->group(function() {
       Route::view('users', 'users.index')->name('users.index');
    });
    Route::middleware(['can:view admin menu'])->group(function() {
        Route::post('admin/toggle-menu', function() {

            $adminMenu = session()->get('preferAdminMenu', false);
            info('preferAdminMenu: ' . json_encode($adminMenu));
            session()->put('preferAdminMenu', !$adminMenu);
            info('preferAdminMenu: ' . json_encode(!$adminMenu));
            return back();
        })->name('admin.toggle');
    });

    Route::middleware(['can:list invites'])->group(function() {
        Route::view('invites', 'invites.index')->name('invites.index');
    });
});

Route::controller(InviteController::class)->group(function() {
    Route::get('invites/accept/{token}', 'accept')->name('invites.accept');
    Route::post('invites/process', 'process')->name('invites.process');
});
