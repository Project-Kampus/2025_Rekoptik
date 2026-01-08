@php
$activeClass = 'bg-blue-50 text-blue-600 font-semibold';
$inactiveClass = 'text-gray-600 hover:bg-gray-100 hover:text-gray-800';

$isRekamMedisActive = request()->routeIs('rekam-medis.*');
$isMasterActive = request()->routeIs('frame.*')
|| request()->routeIs('lensa.*')
|| request()->routeIs('supplier.*');

$isAdminActive = request()->routeIs('admin.*');
$isPengaturanActive = request()->routeIs('pengaturan.*');
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

   <!-- Manajemen Pengguna -->
   <li x-data="{ open: {{ $isAdminActive ? 'true' : 'false' }} }">
      <button @click="open = !open"
         class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg transition
            {{ $isAdminActive ? $activeClass : $inactiveClass }}">
         <span>Manajemen Pengguna</span>
         <svg class="w-4 h-4 transition-transform"
            :class="open ? 'rotate-180' : ''"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M19 9l-7 7-7-7" />
         </svg>
      </button>

      <ul x-show="open" x-collapse class="mt-1 ml-4 space-y-1">
         <li>
            <a href="{{ route('admin.index') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('admin.index') ? $activeClass : $inactiveClass }}">
               Data Pengguna
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
            <a href="{{ route('supplier.index') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('supplier.*') ? $activeClass : $inactiveClass }}">
               Supplier
            </a>
         </li>
         <li>
            <a href="{{ route('frame.index') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('frame.*') ? $activeClass : $inactiveClass }}">
               Frame
            </a>
         </li>
         <li>
            <a href="{{ route('lensa.index') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('lensa.*') ? $activeClass : $inactiveClass }}">
               Lensa
            </a>
         </li>
      </ul>
   </li>

   <!-- Rekam Medis -->
   <li x-data="{ open: false }">
      <button @click="open = !open"
         class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg transition {{ $inactiveClass }}">
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
            <a href="#"
               class="block px-4 py-2 rounded-md transition {{ $inactiveClass }}">
               Data Pasien
            </a>
         </li>
         <li>
            <a href="#"
               class="block px-4 py-2 rounded-md transition {{ $inactiveClass }}">
               Data Pemeriksaan
            </a>
         </li>
         <li>
            <a href="#"
               class="block px-4 py-2 rounded-md transition {{ $inactiveClass }}">
               Data Resep Kacamata
            </a>
         </li>
      </ul>
   </li>



   <!-- Transaksi -->
   <li x-data="{ open: false }">
      <button @click="open = !open"
         class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg transition {{ $inactiveClass }}">
         <span>Transaksi</span>
         <svg class="w-4 h-4 transition-transform"
            :class="open ? 'rotate-180' : ''"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M19 9l-7 7-7-7" />
         </svg>
      </button>
      <ul x-show="open" x-collapse class="mt-1 ml-4 space-y-1">
         <li>
            <a href="#"
               class="block px-4 py-2 rounded-md transition {{ $inactiveClass }}">
               Pesan Kacamata
            </a>
         </li>
         <li>
            <a href="#"
               class="block px-4 py-2 rounded-md transition {{ $inactiveClass }}">
               Data Pemesanan
            </a>
         </li>
         <li>
            <a href="#"
               class="block px-4 py-2 rounded-md transition {{ $inactiveClass }}">
               Riwayat Pembayaran
            </a>
         </li>
      </ul>
   </li>

   <!-- Laporan -->
   <li x-data="{ open: false }">
      <button @click="open = !open"
         class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg transition {{ $inactiveClass }}">
         <span>Laporan</span>
         <svg class="w-4 h-4 transition-transform"
            :class="open ? 'rotate-180' : ''"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M19 9l-7 7-7-7" />
         </svg>
      </button>

      <ul x-show="open" x-collapse class="mt-1 ml-4 space-y-1">
         <li>
            <a href="{{ route('rekam-medis.rekap') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('rekam-medis.rekap') ? $activeClass : $inactiveClass }}">
               Rekap Pemeriksaan
            </a>
         </li>
         <li>
            <a href="#"
               class="block px-4 py-2 rounded-md transition {{ $inactiveClass }}">
               Rekap Transaksi
            </a>
         </li>
         <li>
            <a href="#"
               class="block px-4 py-2 rounded-md transition {{ $inactiveClass }}">
               Rekap Rekam Medis
            </a>
         </li>
         <li>
            <a href="#"
               class="block px-4 py-2 rounded-md transition {{ $inactiveClass }}">
               Export Excel
            </a>
         </li>
      </ul>
   </li>

   <!-- Pengaturan -->
   <li class="my-3 border-t border-gray-200"></li>
   <li>
      <a href="{{ route('dashboard') }}"
         class="flex items-center px-4 py-2.5 rounded-lg transition
           {{ request()->routeIs('dashboard') ? $activeClass : $inactiveClass }}">
         Pengaturan
      </a>
   </li>



   <li x-data="{ open: {{ $isPengaturanActive ? 'true' : 'false' }} }">
      <button @click="open = !open"
         class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg transition
            {{ $isPengaturanActive ? $activeClass : $inactiveClass }}">
         <span>Pengaturan</span>
         <svg class="w-4 h-4 transition-transform"
            :class="open ? 'rotate-180' : ''"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M19 9l-7 7-7-7" />
         </svg>
      </button>

      <ul x-show="open" x-collapse class="mt-1 ml-4 space-y-1">
         <li>
            <a href="#"
               class="block px-4 py-2 rounded-md transition {{ $inactiveClass }}">
               Profil Optik
            </a>
         </li>
         <li>
            <a href="{{ route('pengaturan.index') }}"
               class="block px-4 py-2 rounded-md transition
                   {{ request()->routeIs('pengaturan.index') ? $activeClass : $inactiveClass }}">
               Pengaturan Aplikasi
            </a>
         </li>
      </ul>
   </li>
</ul>