<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Customer;
use App\Models\Feature;
use App\Models\Menu;
use App\Models\Question;
use App\Models\Testimonial;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

use Livewire\Component;
use Popplestones\Quickbooks\Facades\CallbackManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if (Schema::hasTable('menus')) {
            View::share('adminMenu', Menu::whereName('Admin')->with('items')->first());
            View::share('mainMenu', Menu::whereName('Main')->with('items')->first());
        }

        if (Schema::hasTable('testimonials')) {
            View::share('testimonial', Testimonial::inRandomOrder()->first());
        }

        if (Schema::hasTable('features')) {
            View::share('features', Feature::all());
        }

        if (Schema::hasTable('questions')) {
            View::share('questions', Question::all());
        }



        View::share('preferAdminMenu', session()->get('preferAdminMenu'), false);
        View::share('preferDarkMode', session()->get('preferDarkMode', false));

        Component::macro('notify', function ($message) {
            $this->dispatchBrowserEvent('notify', $message);
        });


        Builder::macro('toCsv', function () {
            $results = $this->get();

            if ($results->count() < 1) return;

            $titles = implode(',', array_keys((array) $results->first()->getAttributes()));

            $values = $results->map(function ($result) {
                return implode(',', collect($result->getAttributes())->map(function ($thing) {
                    return '"'.$thing.'"';
                })->toArray());
            });

            $values->prepend($titles);

            return $values->implode("\n");
        });

        // Quickbooks Stuff
        CallbackManager::registerAccounts(
            fn () => Account::query(),
            fn ($q) => $q->whereNull('qb_account_id')->whereSync(true)
        );

        CallbackManager::registerCustomers(
            fn() => Customer::query(),
            fn ($q) => $q->whereNull('qb_customer_id')->whereSync(true)
        );
    }
}
