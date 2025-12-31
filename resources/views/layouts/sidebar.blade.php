@php
$activeClass = 'bg-blue-50 text-blue-600 font-semibold';
$inactiveClass = 'text-gray-600 hover:bg-gray-100 hover:text-gray-800';

$isRekamMedisActive = request()->routeIs('rekam-medis.*');
$isMasterActive = request()->routeIs('frame.*')
|| request()->routeIs('lensa.*')
|| request()->routeIs('supplier.*');
@endphp

<ul class="px-3 py-4 space-y-2 text-sm">

   <!-- Dashboard -->
   <li>
      <a href="{{ route('dashboard') }}"
         class="flex items-center px-4 py-2.5 rounded-lg transition
           {{ request()->routeIs('dashboard') ? $activeClass : $inactiveClass }}">
         Dashboard
      </a>
   </li>

   <li class="my-3 border-t border-gray-200"></li>

   <!-- Rekam Medis -->
   <li x-data="{ open: {{ $isRekamMedisActive ? 'true' : 'false' }} }">
      <button @click="open = !open"
         class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg transition
            {{ $isRekamMedisActive ? $activeClass : $inactiveClass }}">
         <span>Rekam Medis</span>
         <svg class="w-4 h-4 transition-transform"
            :class="open ? 'rotate-180' : ''"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M19 9l-7 7-7-7" />
         </svg>
      </button>

      <ul x-show="open" x-collapse class="mt-1 ml-4 space-y-1">
         <li>
            <a href="{{ route('rekam-medis.create') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('rekam-medis.create') ? $activeClass : $inactiveClass }}">
               Rekam Medis Baru
            </a>
         </li>
         <li>
            <a href="{{ route('rekam-medis.index') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('rekam-medis.index') ? $activeClass : $inactiveClass }}">
               Data Rekam Medis
            </a>
         </li>
         <li>
            <a href="{{ route('rekam-medis.rekap') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('rekam-medis.rekap') ? $activeClass : $inactiveClass }}">
               Rekap Rekam Medis
            </a>
         </li>
      </ul>
   </li>

   <!-- Master Data -->
   <li x-data="{ open: {{ $isMasterActive ? 'true' : 'false' }} }">
      <button @click="open = !open"
         class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg transition
            {{ $isMasterActive ? $activeClass : $inactiveClass }}">
         <span>Master Data</span>
         <svg class="w-4 h-4 transition-transform"
            :class="open ? 'rotate-180' : ''"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M19 9l-7 7-7-7" />
         </svg>
      </button>

      <ul x-show="open" x-collapse class="mt-1 ml-4 space-y-1">

         <li>
            <a href="{{ route('frame.index') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('frame.*') ? $activeClass : $inactiveClass }}">
               Kelola Frame
            </a>
         </li>

         <li>
            <a href="{{ route('lensa.index') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('lensa.*') ? $activeClass : $inactiveClass }}">
               Kelola Lensa
            </a>
         </li>

         <li>
            <a href="{{ route('supplier.index') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('supplier.*') ? $activeClass : $inactiveClass }}">
               Kelola Supplier
            </a>
         </li>

      </ul>
   </li>

   <!-- Riwayat -->
   <li>
      <a href="{{ route('riwayat.all') }}"
         class="flex items-center px-4 py-2.5 rounded-lg transition
           {{ request()->routeIs('riwayat.*') ? $activeClass : $inactiveClass }}">
         Riwayat Frame & Lensa
      </a>
   </li>

   <li class="my-3 border-t border-gray-200"></li>

   <!-- Pengaturan -->
   <li>
      <a href="{{ route('pengaturan.index') }}"
         class="flex items-center px-4 py-2.5 rounded-lg transition
           {{ request()->routeIs('pengaturan.*') ? $activeClass : $inactiveClass }}">
         Pengaturan Sistem
      </a>
   </li>

</ul>