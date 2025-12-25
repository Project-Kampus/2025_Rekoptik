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
        <div class="flex items-center justify-between px-6 py-3">
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
                            <img src="https://ui-avatars.com/api/?name=Admin" class="ms-2 w-8 h-8 rounded-full " alt="avatar">
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
    <aside class="fixed top-14 left-0 w-64 h-full bg-white shadow">
        @include('layouts.sidebar')
    </aside>

    <!-- Main Content -->
    <main class="ml-64 pt-20 px-6">
        <header class="bg-white shadow shadow-sm sm:rounded-lg">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        {{$slot}}

    </main>

</html>