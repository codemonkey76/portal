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

    Route::middleware(['can:view users'])->group(function() {
       Route::view('users', 'users.index')->name('users.index');
    });

    Route::middleware(['can:view customers'])->group(function() {
        Route::view('customers', 'customers.index')->name('customers.index');
    });

    Route::middleware(['can:view admin menu'])->group(function() {
        Route::post('admin/toggle-menu', [AdminMenuController::class])->name('admin.toggle');
    });

    Route::middleware(['can:view invites'])->group(function() {
        Route::view('invites', 'invites.index')->name('invites.index');
    });

    Route::middleware(['can:view menus'])->group(function() {
        Route::view('menus', 'menus.index')->name('menus.index');
    });

    Route::middleware(['can:view permissions'])->group(function() {
        Route::view('permissions', 'permissions.index')->name('permissions.index');
    });

    Route::middleware(['can:view voip servers'])->group(function() {
        Route::view('voip_servers', 'voip_servers.index')->name('voip_servers.index');
    });
    
});

Route::controller(InviteController::class)->group(function() {
    Route::get('invites/accept/{token}', 'accept')->name('invites.accept');
    Route::post('invites/process', 'process')->name('invites.process');
});

Route::post('website_contact', [WebsiteContactController::class, 'store'])->name('website_contact.store');
Route::post('newsletter_subscription', [NewsletterSubscriptionController::class, 'store'])->name('newsletter.subscribe');