<?php

use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\WebsiteContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');


    Route::view('users', 'users.index')->middleware('can:view users')->name('users.index');

    Route::middleware(['can:view customers'])->group(function() {
        Route::view('customers', 'customers.index')->name('customers.index');
        Route::view('customers/{customer}', 'customers.show')->name('customers.show');
    });

    Route::view('service_agreements', 'service_agreements.index')->middleware('can:view service agreements')->name('service_agreements.index');
    Route::view('service_agreements/create', 'service_agreements.create')->middleware('can:create service agreements')->name('service_agreements.create');
    Route::post('admin/toggle-menu', [AdminMenuController::class])->middleware('can:view admin menu')->name('admin.toggle');
    Route::view('invites', 'invites.index')->middleware('can:view invites')->name('invites.index');
    Route::view('menus', 'menus.index')->middleware('can:view menus')->name('menus.index');
    Route::view('permissions', 'permissions.index')->middleware('can:view permissions')->name('permissions.index');
    Route::view('voip_servers', 'voip_servers.index')->middleware('can:view voip servers')->name('voip_servers.index');
    Route::view('service_providers', 'service_providers.index')->middleware('can:view service providers')->name('service_providers.index');
});

Route::controller(InviteController::class)->group(function() {
    Route::get('invites/accept/{token}', 'accept')->name('invites.accept');
    Route::post('invites/process', 'process')->name('invites.process');
});

Route::post('website_contact', [WebsiteContactController::class, 'store'])->name('website_contact.store');
Route::post('newsletter_subscription', [NewsletterSubscriptionController::class, 'store'])->name('newsletter.subscribe');
