<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ $pengaturan->nama_aplikasi ?? config('app.name', 'Laravel') }}
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @php
        $logo = $pengaturan->logo ?? null;
    @endphp

    @if ($logo)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $logo) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    @endif

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- ---------------------------------------------------------------- -->

<body class="bg-gray-100" x-data="{ sidebarOpen: false }">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow">
        <div class="flex items-center justify-between px-6 py-2">

            <!-- Hamburger Menu for Mobile -->
            <button @click="sidebarOpen = !sidebarOpen"
                class="md:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>

            <!-- LOGO & NAMA -->
            <a href="{{ route('welcome') }}" class="hidden md:flex items-center gap-3">
                @if (!empty($pengaturan?->logo))
                    <img src="{{ asset('storage/' . $pengaturan->logo) }}" class="h-9 w-auto" alt="Logo">
                @endif

                <span class="text-xl font-bold text-blue-600">
                    {{ $pengaturan->nama_aplikasi ?? 'Rekoptik' }}
                </span>
            </a>


            <!-- Account -->
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
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
    <aside
        class="top-16 fixed left-0 w-64 h-[calc(100vh-3.5rem)]
        bg-white border-r border-gray-200
        transform
        md:translate-x-0
        duration-200 ease-in-out z-40"
        :class="{ '-translate-x-full': !sidebarOpen }">
        <x-sidebar />
    </aside>


    <!-- Overlay for mobile -->
    <div class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden" x-show="sidebarOpen" @click="sidebarOpen = false">
    </div>

    <!-- Main Content -->
    <main class="md:ml-64 pt-20 px-6 bg-gray-100 min-h-screen">

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
            <div class="flex-grow flex flex-col space-y-3">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <footer class="mt-8 border-t bg-white">
                <div class="px-6 py-4 flex flex-col sm:flex-row justify-between text-sm text-gray-500">
                    <div>
                        © {{ date('Y') }}
                        <span class="font-medium text-gray-700">
                            {{ $pengaturan->nama_aplikasi ?? 'Rekoptik' }}
                        </span>
                    </div>

                    <div class="mt-2 sm:mt-0">
                        {{ $pengaturan->footer ?? 'All rights reserved.' }}
                    </div>
                </div>
            </footer>


        </div>

    </main>

    <!-- Notification -->
    @include('layouts.notification')

    <!-- Componen Select Search -->

    <!-- Componen Form Input Type Rupiah -->
    <script src="{{ asset('app/Component/form-input.js') }}"></script>



</html>
