<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#1a1a1a] text-gray-100">
        <div class="min-h-screen bg-gradient-to-b from-[#1a1a1a] to-[#2c2c2c]">
            {{-- Navigation --}}
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-[#2b1b1b] shadow-md border-b border-yellow-600">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-[#f2c94c] font-semibold">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
