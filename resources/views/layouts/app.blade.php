<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />
    <x-notification />

    <div class="min-h-screen h-screen bg-gray-100 flex flex-col">

        <!-- Page Content -->
        <main class="flex-1 flex h-screen">
            <div class="flex flex-1">
                <livewire:sidebar />
                <div class="flex-1 overflow-auto">
                    <!-- Page Heading -->
                    @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                    @endif

                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 space-y-4">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
    </div>


    @stack('modals')
    @livewireScripts
</body>

</html>
