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

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow">
        <div class="flex items-center justify-between px-6 py-2">
            <!-- Logo -->
            <div class="text-xl font-bold text-blue-600">
                Rekoptik
            </div>

            <!-- Account -->
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                                class="ms-2 w-8 h-8 rounded-full" alt="avatar">
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="top-16 fixed left-0 w-64 h-[calc(100vh-3.5rem)] bg-white border-r border-gray-200">
        @include('layouts.sidebar')
    </aside>


    <!-- Main Content -->
    <main class="ml-64 pt-20 px-6 bg-gray-100 min-h-screen">
        <!-- Header -->
        @if (isset($header))
        <header class="max-w-7xl mx-auto bg-white border border-gray-200 rounded-lg mb-4">
            <div class="px-6 py-4 flex items-center justify-between">
                <!-- Title -->
                {{ $header }}
                <!-- Header Action (optional) -->
                @isset($headerAction)
                <div class="flex items-center gap-2">
                    {{ $headerAction }}
                </div>
                @endisset
            </div>
        </header>
        @endif

        <!-- Content -->
        <div class="flex flex-col space-y-2 max-w-7xl mx-auto">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <footer class="mt-8 border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row items-center justify-between text-sm text-gray-500">
                <div>
                    © {{ date('Y') }} <span class="font-medium text-gray-700">Rekoptik</span>. All rights reserved.
                </div>
                <div class="flex items-center gap-4 mt-2 sm:mt-0">
                    <a href="#" class="hover:text-gray-700 transition">Privacy Policy</a>
                    <a href="#" class="hover:text-gray-700 transition">Terms</a>
                    <a href="#" class="hover:text-gray-700 transition">Support</a>
                </div>

            </div>
        </footer>

    </main>


</html>