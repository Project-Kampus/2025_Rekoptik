<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name', 'Laravel') }} </title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
     
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow">
        <div class="flex items-center justify-between px-6 py-2">
            <!-- Logo -->
            <a href="{{ route('welcome') }}" class="text-xl font-bold text-blue-600">
                Rekoptik
            </a>


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

        <!-- Wrapper Flex -->
        <div class="mx-auto flex flex-col min-h-[calc(100vh-5rem)]">

            <!-- Header -->
            @if (isset($header))
            <header class="bg-white border border-gray-200 rounded-lg mb-4">
                <div class="px-6 py-4 flex items-center justify-between">
                    {{ $header }}

                    @isset($headerAction)
                    <div class="flex items-center gap-2">
                        {{ $headerAction }}
                    </div>
                    @endisset
                </div>
            </header>
            @endif

            <!-- Content -->
            <div class="flex-grow flex flex-col space-y-2">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <footer class="mt-8 border-t border-gray-200">
                <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between text-sm text-gray-500">
                    <div>
                        © {{ date('Y') }} <span class="font-medium text-gray-700">Rekoptik</span>. All rights reserved.
                    </div>
                    <div class="flex items-center gap-4 mt-2 sm:mt-0">
                        <a href="#" class="hover:text-gray-700">Privacy Policy</a>
                        <a href="#" class="hover:text-gray-700">Terms</a>
                        <a href="#" class="hover:text-gray-700">Support</a>
                    </div>
                </div>
            </footer>

        </div>

    </main>

    <!-- Notification -->
    @if (session('success') || session('error') || $errors->any())
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-200"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0"
        class="fixed top-20 right-6 z-50 max-w-sm w-full">
        <div class="
        flex items-start gap-3
        px-4 py-3 rounded-lg shadow-lg border
        @if (session('success'))
            bg-green-50 border-green-200
        @elseif (session('error') || $errors->any())
            bg-red-50 border-red-200
        @endif
    ">
            <!-- Close Button (Left) -->
            <button
                @click="show = false"
                class="text-gray-400 hover:text-gray-600 focus:outline-none">
                ✕
            </button>

            <!-- Content -->
            <div class="flex-1 text-sm">
                @if (session('success'))
                <p class="font-medium text-green-700">
                    {{ session('success') }}
                </p>
                @elseif (session('error'))
                <p class="font-medium text-red-700">
                    {{ session('error') }}
                </p>
                @elseif ($errors->any())
                <p class="font-medium text-red-700 mb-1">
                    Terjadi kesalahan:
                </p>
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
    @endif



</html>