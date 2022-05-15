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
            'label'               => 'Dashboard',
            'route'               => 'dashboard',
            'permission_required' => 'view dashboard',
            'icon'                => '<svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>'
        ]);
        $main->items()->create([
            'label'               => 'Billing',
            'route'               => 'billing',
            'permission_required' => 'view billing',
            'icon'                => '<svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="svg-inline--fa fa-money-check-alt fa-w-20 w-5 h-5" data-icon="money-check-alt" data-prefix="fas" viewBox="0 0 640 512"><path fill="currentColor" d="M608 32H32C14.33 32 0 46.33 0 64v384c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V64c0-17.67-14.33-32-32-32zM176 327.88V344c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-16.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V152c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v16.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07zM416 312c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h112c4.42 0 8 3.58 8 8v16zm160 0c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-96c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h272c4.42 0 8 3.58 8 8v16z"></path></svg></svg>'
        ]);
        $main->items()->create([
            'label'               => 'Calls',
            'route'               => 'cdrs',
            'permission_required' => 'view calls',
            'icon'                => '<svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><svg aria-hidden="true" data-prefix="fas" data-icon="phone-square-alt" class="svg-inline--fa fa-phone-square-alt fa-w-14 w-5 h-5 mr-2" viewBox="0 0 448 512"><path fill="currentColor" d="M400 32H48A48 48 0 000 80v352a48 48 0 0048 48h352a48 48 0 0048-48V80a48 48 0 00-48-48zm-16.39 307.37l-15 65A15 15 0 01354 416C194 416 64 286.29 64 126a15.7 15.7 0 0111.63-14.61l65-15A18.23 18.23 0 01144 96a16.27 16.27 0 0113.79 9.09l30 70A17.9 17.9 0 01189 181a17 17 0 01-5.5 11.61l-37.89 31a231.91 231.91 0 00110.78 110.78l31-37.89A17 17 0 01299 291a17.85 17.85 0 015.91 1.21l70 30A16.25 16.25 0 01384 336a17.41 17.41 0 01-.39 3.37z"></path></svg></svg>'
        ]);

        $main->items()->create([
            'label'               => 'SMS',
            'route'               => 'sms',
            'permission_required' => 'view sms',
            'icon'                => '<svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M416 256V63.1C416 28.75 387.3 0 352 0H64C28.75 0 0 28.75 0 63.1v192C0 291.2 28.75 320 64 320l32 .0106v54.25c0 7.998 9.125 12.62 15.5 7.875l82.75-62.12L352 319.9C387.3 320 416 291.2 416 256zM576 128H448v128c0 52.87-43.13 95.99-96 95.99l-96 .0013v31.98c0 35.25 28.75 63.1 63.1 63.1l125.8-.0073l82.75 62.12C534.9 514.8 544 510.2 544 502.2v-54.24h32c35.25 0 64-28.75 64-63.1V191.1C640 156.7 611.3 128 576 128z"></path></svg></svg>'
        ]);


        $admin = Menu::create(['name' => 'Admin']);
        $admin->items()->create([
            'label'               => 'Dashboard',
            'route'               => 'admin.dashboard',
            'permission_required' => 'view admin dashboard',
            'icon'                => '<svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>'
        ]);

        $admin->items()->create([
            'label'               => 'Customers',
            'route'               => 'customers.index',
            'permission_required' => 'customers.index',
            'icon'                => '<svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="svg-inline--fa fa-building fa-w-14 w-5 h-5" data-icon="building" data-prefix="fas" viewBox="0 0 448 512"><path fill="currentColor" d="M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z"></path></svg></svg>'
        ]);

        $admin->items()->create([
            'label' => 'Accounts',
            'route' => 'accounts.index',
            'permission_required' => 'accounts.index',
            'icon' => '<svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M528 32h-480C21.49 32 0 53.49 0 80v352C0 458.5 21.49 480 48 480h480c26.51 0 48-21.49 48-48v-352C576 53.49 554.5 32 528 32zM128 264H112C103.2 264 96 271.2 96 280v16c0 8.836 7.164 16 16 16H128v24H112C103.2 336 96 343.2 96 352v16c0 8.836 7.164 16 16 16L128 384l0 32L64 416V240h64V264zM128 128L112 128C103.2 128 96 135.2 96 144V160c0 8.836 7.164 16 16 16H128v32H64V96l63.1 .0002L128 128zM256 264H240C231.2 264 224 271.2 224 280v16c0 8.836 7.164 16 16 16H256v24H240C231.2 336 224 343.2 224 352v16c0 8.836 7.164 16 16 16L256 384v32H160L160 384l16 .0002c8.836 0 16-7.164 16-16V352c0-8.836-7.164-16-16-16H160V312h16c8.836 0 16-7.164 16-16v-16c0-8.836-7.164-16-16-16H160V240h96V264zM256 128L240 128C231.2 128 224 135.2 224 144V160c0 8.836 7.164 16 16 16H256v32H160v-32h16C184.8 176 192 168.8 192 160V144c0-8.836-7.164-15.1-16-15.1L160 128l0-31.1H256V128zM416 336h-16c-8.836 0-16 7.164-16 16v16c0 8.836 7.164 16 16 16L416 384v32h-128V384l16 .0002c8.836 0 16-7.164 16-16V352c0-8.836-7.164-16-16-16H288V312h16c8.836 0 16-7.164 16-16v-16c0-8.836-7.164-16-16-16H288V240h128V336zM416 128l-16 .0002C391.2 128 384 135.2 384 144V160c0 8.836 7.164 16 16 16H416v32h-128v-32h16C312.8 176 320 168.8 320 160V144c0-8.836-7.164-15.1-16-15.1L288 128V96h128V128zM512 416l-64 .0002V384l16 .0002c8.836 0 16-7.164 16-16V352c0-8.836-7.164-16-16-16H448v-96h64V416zM512 208h-64v-32h16C472.8 176 480 168.8 480 160V144c0-8.836-7.164-15.1-16-15.1L448 128V96L512 96V208z"/></svg>'
        ]);
        $admin->items()->create([
            'label'               => 'Products',
            'route'               => 'products.index',
            'permission_required' => 'products.index',
            'icon'                => '<svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M171.7 191.1H404.3L322.7 35.07C316.6 23.31 321.2 8.821 332.9 2.706C344.7-3.409 359.2 1.167 365.3 12.93L458.4 191.1H544C561.7 191.1 576 206.3 576 223.1C576 241.7 561.7 255.1 544 255.1L492.1 463.5C484.1 492 459.4 512 430 512H145.1C116.6 512 91 492 83.88 463.5L32 255.1C14.33 255.1 0 241.7 0 223.1C0 206.3 14.33 191.1 32 191.1H117.6L210.7 12.93C216.8 1.167 231.3-3.409 243.1 2.706C254.8 8.821 259.4 23.31 253.3 35.07L171.7 191.1zM191.1 303.1C191.1 295.1 184.8 287.1 175.1 287.1C167.2 287.1 159.1 295.1 159.1 303.1V399.1C159.1 408.8 167.2 415.1 175.1 415.1C184.8 415.1 191.1 408.8 191.1 399.1V303.1zM271.1 303.1V399.1C271.1 408.8 279.2 415.1 287.1 415.1C296.8 415.1 304 408.8 304 399.1V303.1C304 295.1 296.8 287.1 287.1 287.1C279.2 287.1 271.1 295.1 271.1 303.1zM416 303.1C416 295.1 408.8 287.1 400 287.1C391.2 287.1 384 295.1 384 303.1V399.1C384 408.8 391.2 415.1 400 415.1C408.8 415.1 416 408.8 416 399.1V303.1z"/></svg>'
        ]);

        $admin->items()->create([
            'label'               => 'Service Agreements',
            'route'               => 'service-agreements.index',
            'permission_required' => 'service-agreements.index',
            'icon'                => '<svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM64 72C64 67.63 67.63 64 72 64h80C156.4 64 160 67.63 160 72v16C160 92.38 156.4 96 152 96h-80C67.63 96 64 92.38 64 88V72zM64 136C64 131.6 67.63 128 72 128h80C156.4 128 160 131.6 160 136v16C160 156.4 156.4 160 152 160h-80C67.63 160 64 156.4 64 152V136zM304 384c8.875 0 16 7.125 16 16S312.9 416 304 416h-47.25c-16.38 0-31.25-9.125-38.63-23.88c-2.875-5.875-8-6.5-10.12-6.5s-7.25 .625-10 6.125l-7.75 15.38C187.6 412.6 181.1 416 176 416H174.9c-6.5-.5-12-4.75-14-11L144 354.6L133.4 386.5C127.5 404.1 111 416 92.38 416H80C71.13 416 64 408.9 64 400S71.13 384 80 384h12.38c4.875 0 9.125-3.125 10.62-7.625l18.25-54.63C124.5 311.9 133.6 305.3 144 305.3s19.5 6.625 22.75 16.5l13.88 41.63c19.75-16.25 54.13-9.75 66 14.12c2 4 6 6.5 10.12 6.5H304z"/></svg>'
        ]);

        $admin->items()->create([
            'label'               => 'Service Providers',
            'route'               => 'service-providers.index',
            'permission_required' => 'service-providers.index',
            'icon'                => '<svg class="mr-4 h-6 w-6 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M216 104C202.8 104 192 114.8 192 128s10.75 24 24 24c79.41 0 144 64.59 144 144C360 309.3 370.8 320 384 320s24-10.75 24-24C408 190.1 321.9 104 216 104zM224 0C206.3 0 192 14.31 192 32s14.33 32 32 32c123.5 0 224 100.5 224 224c0 17.69 14.33 32 32 32s32-14.31 32-32C512 129.2 382.8 0 224 0zM188.9 346l27.37-27.37c2.625 .625 5.059 1.506 7.809 1.506c17.75 0 31.99-14.26 31.99-32c0-17.62-14.24-32.01-31.99-32.01c-17.62 0-31.99 14.38-31.99 32.01c0 2.875 .8099 5.25 1.56 7.875L166.2 323.4L49.37 206.5c-7.25-7.25-20.12-6-24.1 3c-41.75 77.88-29.88 176.7 35.75 242.4c65.62 65.62 164.6 77.5 242.4 35.75c9.125-5 10.38-17.75 3-25L188.9 346z"/></svg>'
        ]);

        // $admin->items()->create([
        //     'label' => 'Transactions',
        //     'route' => 'transactions.index',
        //     'permission_required' => 'view transactions',
        //     'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M384 128h-128V0L384 128zM256 160H384v304c0 26.51-21.49 48-48 48h-288C21.49 512 0 490.5 0 464v-416C0 21.49 21.49 0 48 0H224l.0039 128C224 145.7 238.3 160 256 160zM64 88C64 92.38 67.63 96 72 96h80C156.4 96 160 92.38 160 88v-16C160 67.63 156.4 64 152 64h-80C67.63 64 64 67.63 64 72V88zM72 160h80C156.4 160 160 156.4 160 152v-16C160 131.6 156.4 128 152 128h-80C67.63 128 64 131.6 64 136v16C64 156.4 67.63 160 72 160zM197.5 316.8L191.1 315.2C168.3 308.2 168.8 304.1 169.6 300.5c1.375-7.812 16.59-9.719 30.27-7.625c5.594 .8438 11.73 2.812 17.59 4.844c10.39 3.594 21.83-1.938 25.45-12.34c3.625-10.44-1.891-21.84-12.33-25.47c-7.219-2.484-13.11-4.078-18.56-5.273V248c0-11.03-8.953-20-20-20s-20 8.969-20 20v5.992C149.6 258.8 133.8 272.8 130.2 293.7c-7.406 42.84 33.19 54.75 50.52 59.84l5.812 1.688c29.28 8.375 28.8 11.19 27.92 16.28c-1.375 7.812-16.59 9.75-30.31 7.625c-6.938-1.031-15.81-4.219-23.66-7.031l-4.469-1.625c-10.41-3.594-21.83 1.812-25.52 12.22c-3.672 10.41 1.781 21.84 12.2 25.53l4.266 1.5c7.758 2.789 16.38 5.59 25.06 7.512V424c0 11.03 8.953 20 20 20s20-8.969 20-20v-6.254c22.36-4.793 38.21-18.53 41.83-39.43C261.3 335 219.8 323.1 197.5 316.8z"/></svg>'
        // ]);

        // $admin->items()->create([
        //     'label' => 'Rate Groups',
        //     'route' => 'route-groups.index',
        //     'permission_required' => 'view rate groups',
        //     'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M512 64C547.3 64 576 92.65 576 128V384C576 419.3 547.3 448 512 448H64C28.65 448 0 419.3 0 384V128C0 92.65 28.65 64 64 64H512zM112 224C103.2 224 96 231.2 96 240C96 248.8 103.2 256 112 256H272C280.8 256 288 248.8 288 240C288 231.2 280.8 224 272 224H112zM112 352H464C472.8 352 480 344.8 480 336C480 327.2 472.8 320 464 320H112C103.2 320 96 327.2 96 336C96 344.8 103.2 352 112 352zM376 160C362.7 160 352 170.7 352 184V232C352 245.3 362.7 256 376 256H456C469.3 256 480 245.3 480 232V184C480 170.7 469.3 160 456 160H376z"/></svg>'
        // ]);

        // $admin->items()->create([
        //     'label' => 'Plan Items',
        //     'route' => 'plan-items.index',
        //     'permission_required' => 'view plan items',
        //     'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M13.97 2.196C22.49-1.72 32.5-.3214 39.62 5.778L80 40.39L120.4 5.778C129.4-1.926 142.6-1.926 151.6 5.778L192 40.39L232.4 5.778C241.4-1.926 254.6-1.926 263.6 5.778L304 40.39L344.4 5.778C351.5-.3214 361.5-1.72 370 2.196C378.5 6.113 384 14.63 384 24V488C384 497.4 378.5 505.9 370 509.8C361.5 513.7 351.5 512.3 344.4 506.2L304 471.6L263.6 506.2C254.6 513.9 241.4 513.9 232.4 506.2L192 471.6L151.6 506.2C142.6 513.9 129.4 513.9 120.4 506.2L80 471.6L39.62 506.2C32.5 512.3 22.49 513.7 13.97 509.8C5.456 505.9 0 497.4 0 488V24C0 14.63 5.456 6.112 13.97 2.196V2.196zM96 144C87.16 144 80 151.2 80 160C80 168.8 87.16 176 96 176H288C296.8 176 304 168.8 304 160C304 151.2 296.8 144 288 144H96zM96 368H288C296.8 368 304 360.8 304 352C304 343.2 296.8 336 288 336H96C87.16 336 80 343.2 80 352C80 360.8 87.16 368 96 368zM96 240C87.16 240 80 247.2 80 256C80 264.8 87.16 272 96 272H288C296.8 272 304 264.8 304 256C304 247.2 296.8 240 288 240H96z"/></svg>'
        // ]);

        $admin->items()->create([
            'label'               => 'VOIP Servers',
            'route'               => 'voip_servers.index',
            'permission_required' => 'voip-servers.index',
            'icon'                => '<svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M480 288H32c-17.62 0-32 14.38-32 32v128c0 17.62 14.38 32 32 32h448c17.62 0 32-14.38 32-32v-128C512 302.4 497.6 288 480 288zM352 408c-13.25 0-24-10.75-24-24s10.75-24 24-24s24 10.75 24 24S365.3 408 352 408zM416 408c-13.25 0-24-10.75-24-24s10.75-24 24-24s24 10.75 24 24S429.3 408 416 408zM480 32H32C14.38 32 0 46.38 0 64v128c0 17.62 14.38 32 32 32h448c17.62 0 32-14.38 32-32V64C512 46.38 497.6 32 480 32zM352 152c-13.25 0-24-10.75-24-24S338.8 104 352 104S376 114.8 376 128S365.3 152 352 152zM416 152c-13.25 0-24-10.75-24-24S402.8 104 416 104S440 114.8 440 128S429.3 152 416 152z"/></svg>'
        ]);

        $admin->items()->create([
            'label'               => 'Invites',
            'route'               => 'invites.index',
            'permission_required' => 'invites.index',
            'icon'                => '<svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 32C96 14.33 110.3 0 128 0C145.7 0 160 14.33 160 32V64H288V32C288 14.33 302.3 0 320 0C337.7 0 352 14.33 352 32V64H400C426.5 64 448 85.49 448 112V160H0V112C0 85.49 21.49 64 48 64H96V32zM416 192.7C326.3 200.8 256 276.2 256 368C256 427.5 285.6 480.1 330.8 512H48C21.49 512 0 490.5 0 464V192H416V192.7zM288 368C288 288.5 352.5 224 432 224C511.5 224 576 288.5 576 368C576 447.5 511.5 512 432 512C352.5 512 288 447.5 288 368zM432 480C462.2 480 489.5 468.1 509.7 448.7C503.5 429.7 485.6 416 464.6 416H399.4C378.4 416 360.5 429.7 354.3 448.7C374.5 468.1 401.8 480 432 480V480zM432 384C458.5 384 480 362.5 480 336C480 309.5 458.5 288 432 288C405.5 288 384 309.5 384 336C384 362.5 405.5 384 432 384z"/></svg>'
        ]);

        $admin->items()->create([
            'label'               => 'Users',
            'route'               => 'users.index',
            'permission_required' => 'users.index',
            'icon'                => '<svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>'
        ]);

        $admin->items()->create([
            'label'               => 'Permissions',
            'route'               => 'permissions.index',
            'permission_required' => 'permissions.index',
            'icon'                => '<svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M282.3 343.7L248.1 376.1C244.5 381.5 238.4 384 232 384H192V424C192 437.3 181.3 448 168 448H128V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V408C0 401.6 2.529 395.5 7.029 391L168.3 229.7C162.9 212.8 160 194.7 160 176C160 78.8 238.8 0 336 0C433.2 0 512 78.8 512 176C512 273.2 433.2 352 336 352C317.3 352 299.2 349.1 282.3 343.7zM376 176C398.1 176 416 158.1 416 136C416 113.9 398.1 96 376 96C353.9 96 336 113.9 336 136C336 158.1 353.9 176 376 176z"/></svg>'
        ]);

        $admin->items()->create([
            'label'               => 'Menus',
            'route'               => 'menus.index',
            'permission_required' => 'menus.index',
            'icon'                => '<svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z"/></svg>'
        ]);
    }
}
