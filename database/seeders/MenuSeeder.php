<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Menu::truncate();
        MenuItem::truncate();
        Schema::enableForeignKeyConstraints();
        $main = Menu::create(['name' => 'Main']);

        $main->items()->create([
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'icon' => '<svg class="mr-4 h-6 w-6 text-gray-300 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>'
        ]);
        $main->items()->create([
            'label' => 'Billing',
            'route' => 'billing',
            'icon' => '<svg class="mr-4 h-6 w-6 transition ease-in-out duration-150 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="svg-inline--fa fa-money-check-alt fa-w-20 w-5 h-5" data-icon="money-check-alt" data-prefix="fas" viewBox="0 0 640 512"><path fill="currentColor" d="M608 32H32C14.33 32 0 46.33 0 64v384c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V64c0-17.67-14.33-32-32-32zM176 327.88V344c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-16.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V152c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v16.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07zM416 312c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h112c4.42 0 8 3.58 8 8v16zm160 0c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-96c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h272c4.42 0 8 3.58 8 8v16z"></path></svg></svg>'
        ]);
        $main->items()->create([
            'label' => 'Calls',
            'route' => 'cdrs',
            'icon' => '<svg class="mr-4 h-6 w-6 transition ease-in-out duration-150 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><svg aria-hidden="true" data-prefix="fas" data-icon="phone-square-alt" class="svg-inline--fa fa-phone-square-alt fa-w-14 w-5 h-5 mr-2" viewBox="0 0 448 512"><path fill="currentColor" d="M400 32H48A48 48 0 000 80v352a48 48 0 0048 48h352a48 48 0 0048-48V80a48 48 0 00-48-48zm-16.39 307.37l-15 65A15 15 0 01354 416C194 416 64 286.29 64 126a15.7 15.7 0 0111.63-14.61l65-15A18.23 18.23 0 01144 96a16.27 16.27 0 0113.79 9.09l30 70A17.9 17.9 0 01189 181a17 17 0 01-5.5 11.61l-37.89 31a231.91 231.91 0 00110.78 110.78l31-37.89A17 17 0 01299 291a17.85 17.85 0 015.91 1.21l70 30A16.25 16.25 0 01384 336a17.41 17.41 0 01-.39 3.37z"></path></svg></svg>'
        ]);

        $main->items()->create([
            'label' => 'SMS',
            'route' => 'sms',
            'icon' => '<svg class="mr-4 h-6 w-6 transition ease-in-out duration-150 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M416 256V63.1C416 28.75 387.3 0 352 0H64C28.75 0 0 28.75 0 63.1v192C0 291.2 28.75 320 64 320l32 .0106v54.25c0 7.998 9.125 12.62 15.5 7.875l82.75-62.12L352 319.9C387.3 320 416 291.2 416 256zM576 128H448v128c0 52.87-43.13 95.99-96 95.99l-96 .0013v31.98c0 35.25 28.75 63.1 63.1 63.1l125.8-.0073l82.75 62.12C534.9 514.8 544 510.2 544 502.2v-54.24h32c35.25 0 64-28.75 64-63.1V191.1C640 156.7 611.3 128 576 128z"></path></svg></svg>'
        ]);


        $admin = Menu::create(['name' => 'Admin']);
        $admin->items()->create([
            'label' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => '<svg class="mr-4 h-6 w-6 text-gray-300 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>'
        ]);
        $admin->items()->create([
            'label' => 'Invites',
            'route' => 'invites.index',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 32C96 14.33 110.3 0 128 0C145.7 0 160 14.33 160 32V64H288V32C288 14.33 302.3 0 320 0C337.7 0 352 14.33 352 32V64H400C426.5 64 448 85.49 448 112V160H0V112C0 85.49 21.49 64 48 64H96V32zM416 192.7C326.3 200.8 256 276.2 256 368C256 427.5 285.6 480.1 330.8 512H48C21.49 512 0 490.5 0 464V192H416V192.7zM288 368C288 288.5 352.5 224 432 224C511.5 224 576 288.5 576 368C576 447.5 511.5 512 432 512C352.5 512 288 447.5 288 368zM432 480C462.2 480 489.5 468.1 509.7 448.7C503.5 429.7 485.6 416 464.6 416H399.4C378.4 416 360.5 429.7 354.3 448.7C374.5 468.1 401.8 480 432 480V480zM432 384C458.5 384 480 362.5 480 336C480 309.5 458.5 288 432 288C405.5 288 384 309.5 384 336C384 362.5 405.5 384 432 384z"/></svg>'
        ]);
        $admin->items()->create([
            'label' => 'Users',
            'route' => 'users.index',
            'icon' => '<svg class="mr-4 h-6 w-6 text-gray-300 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>'
        ]);
        $admin->items()->create([
            'label' => 'Customers',
            'route' => 'customers.index',
            'icon' => '<svg class="mr-4 h-6 w-6 text-gray-300 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="svg-inline--fa fa-building fa-w-14 w-5 h-5" data-icon="building" data-prefix="fas" viewBox="0 0 448 512"><path fill="currentColor" d="M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z"></path></svg></svg>'
        ]);
        // $admin->items()->create([
        //     'label' => '',
        //     'route' => '',
        //     'icon' => ''
        // ]);
        // $admin->items()->create([
        //     'label' => '',
        //     'route' => '',
        //     'icon' => ''
        // ]);
        // $admin->items()->create([
        //     'label' => '',
        //     'route' => '',
        //     'icon' => ''
        // ]);
    }
}
