<?php

use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NewsletterSubscriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceAgreementController;
use App\Http\Controllers\WebsiteContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');


    Route::view('users', 'users.index')
         ->middleware('can:users.index')
         ->name('users.index');

    Route::resource('customers', CustomerController::class)->only(['index', 'show']);
    Route::resource('invoices', InvoiceController::class)->only(['edit', 'show']);
    Route::resource('payments', PaymentController::class)->only(['edit']);

    Route::resource('service-agreements', ServiceAgreementController::class);

    Route::post('admin/toggle-menu', [AdminMenuController::class])
         ->middleware('can:view admin menu')
         ->name('admin.toggle');

    Route::view('invites', 'invites.index')
         ->middleware('can:invites.index')
         ->name('invites.index');

    Route::view('items', 'items.index')
        ->middleware('can:items.index')
        ->name('items.index');

    Route::view('products', 'products.index')
         ->middleware('can:products.index')
         ->name('products.index');

    Route::view('accounts', 'accounts.index')
         ->middleware('can:accounts.index')
         ->name('accounts.index');

    Route::view('menus', 'menus.index')
         ->middleware('can:menus.index')
         ->name('menus.index');

    Route::view('permissions', 'permissions.index')
         ->middleware('can:permissions.index')
         ->name('permissions.index');

    Route::view('voip_servers', 'voip_servers.index')
         ->middleware('can:voip-servers.index')
         ->name('voip_servers.index');

    Route::view('service_providers', 'service_providers.index')
         ->middleware('can:service-providers.index')
         ->name('service_providers.index');
});

Route::controller(InviteController::class)->group(function() {
    Route::get('invites/accept/{token}', 'accept')->name('invites.accept');
    Route::post('invites/process', 'process')->name('invites.process');
});

Route::controller(ServiceAgreementController::class)->group(function() {
    Route::get('agreements/accept/{token}', 'accept')->name('agreements.accept');
    Route::post('agreements/process', 'process')->name('agreements.process');
});

Route::post('website_contact', [WebsiteContactController::class, 'store'])->name('website_contact.store');
Route::post('newsletter_subscription', [NewsletterSubscriptionController::class, 'store'])->name('newsletter.subscribe');
