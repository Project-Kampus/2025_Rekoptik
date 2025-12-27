@php
$activeClass = 'bg-blue-50 text-blue-600 font-medium';
$inactiveClass = 'text-gray-600 hover:bg-gray-100 hover:text-gray-800';

$isFrameActive = request()->routeIs('frame.*');
@endphp

<ul class="px-3 py-4 space-y-2 text-sm">

   <!-- Dashboard -->
   <li>
      <a href="{{ route('dashboard') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
         {{ request()->routeIs('dashboard') ? $activeClass : $inactiveClass }}">
         <span>Dashboard</span>
      </a>
   </li>

   <li class="my-3 border-t border-gray-200"></li>

   <!-- Rekam Medis -->
   <li>
      <a href="{{ route('rekam-medis.index') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
         {{ request()->routeIs('rekam-medis.*') ? $activeClass : $inactiveClass }}">
         <span>Rekam Medis</span>
      </a>
   </li>

   <!-- MANAGEMEN FRAME (PARENT) -->
   <li x-data="{ open: {{ $isFrameActive ? 'true' : 'false' }} }">

      <!-- Parent -->
      <button
         @click="open = !open"
         class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg transition
         {{ $isFrameActive ? $activeClass : $inactiveClass }}">

         <span>Manajemen Frame</span>

         <svg class="w-4 h-4 transition-transform"
            :class="open ? 'rotate-180' : ''"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M19 9l-7 7-7-7" />
         </svg>
      </button>

      <!-- Submenu -->
      <ul x-show="open" x-collapse class="mt-1 ml-4 space-y-1">

         <li>
            <a href="{{ route('frame.index') }}"
               class="block px-4 py-2 rounded-md transition
               {{ request()->routeIs('frame.index') ? $activeClass : $inactiveClass }}">
               Data Frame
            </a>
         </li>

         <li>
            <a href="{{ route('frame.riwayat.all') }}"
               class="block px-4 py-2 rounded-md transition
               {{ request()->routeIs('frame.riwayat.*') ? $activeClass : $inactiveClass }}">
               Riwayat Frame
            </a>
         </li>

      </ul>
   </li>

   <li class="my-3 border-t border-gray-200"></li>

   <!-- Pengaturan Sistem -->
   <li>
      <a href="{{ route('settings.index') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
         {{ request()->routeIs('settings.*') ? $activeClass : $inactiveClass }}">
         <span>Pengaturan Sistem</span>
      </a>
   </li>

</ul>