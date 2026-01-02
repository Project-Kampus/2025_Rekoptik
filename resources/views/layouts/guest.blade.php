<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rekoptik') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @php
    $logo = $pengaturan->logo ?? null;
    @endphp

    @if($logo)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $logo) }}">
    @else
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    @endif


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="/" class="flex flex-col items-center gap-2">
                    @if ($logo)
                    <img
                        src="{{ asset('storage/' . $logo) }}"
                        alt="Logo {{ config('app.name') }}"
                        class="h-16 sm:h-20 object-contain">
                    @else
                    <img
                        src="{{ asset('favicon.png') }}"
                        alt="Logo {{ config('app.name') }}"
                        class="h-16 sm:h-20 object-contain">
                    @endif

                    <span class="text-xl font-bold tracking-wide text-blue-600">
                        {{ config('app.name') }}
                    </span>
                </a>
            </div>

            <!-- Card -->
            <div class="bg-white shadow-lg rounded-xl px-6 py-8 sm:px-8 sm:py-10">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <p class="mt-6 text-center text-xs text-gray-500">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>

        </div>
    </div>
</body>


</html>