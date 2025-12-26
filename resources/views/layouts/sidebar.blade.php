@php
$activeClass = 'bg-blue-50 text-blue-600 font-medium';
$inactiveClass = 'text-gray-600 hover:bg-gray-100 hover:text-gray-800';
@endphp

<ul class="px-3 py-4 space-y-2 text-sm">

   <!-- Dashboard -->
   <li>
      <a href="{{ route('dashboard') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition leading-tight
           {{ request()->routeIs('dashboard') ? $activeClass : $inactiveClass }}">

         <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
         </svg>

         <span>Dashboard</span>
      </a>
   </li>

   <!-- Divider -->
   <li class="my-3 border-t border-gray-200"></li>

   <!-- Rekam Medis -->
   <li>
      <a href="{{ route('rekam-medis.index') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition leading-tight
           {{ request()->routeIs('rekam-medis.*') ? $activeClass : $inactiveClass }}">

         <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M9 12h6m-3-3v6M4.5 19.5h15A1.5 1.5 0 0021 18V6A1.5 1.5 0 0019.5 4.5h-15A1.5 1.5 0 003 6v12A1.5 1.5 0 004.5 19.5z" />
         </svg>

         <span>Rekam Medis</span>
      </a>
   </li>

   <!-- Manajemen Frame -->
   <li>
      <a href="{{ route('frame.index') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition leading-tight
           {{ request()->routeIs('frame.*') ? $activeClass : $inactiveClass }}">

         <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke-width="2" />
         </svg>

         <span>Manajemen Freme</span>
      </a>
   </li>

   <!-- Divider -->
   <li class="my-3 border-t border-gray-200"></li>

   <!-- Pengaturan Sistem -->
   <li>
      <a href="{{ route('settings.index') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition leading-tight
           {{ request()->routeIs('settings.*') ? $activeClass : $inactiveClass }}">

         <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M12 6.75V3m0 18v-3.75M6.75 12H3m18 0h-3.75" />
         </svg>

         <span>Pengaturan Sistem</span>
      </a>
   </li>

</ul>