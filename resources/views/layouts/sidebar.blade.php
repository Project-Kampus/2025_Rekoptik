@php
$activeClass = 'bg-blue-50 text-blue-600 font-medium';
$inactiveClass = 'text-gray-600 hover:bg-gray-100 hover:text-gray-800';
@endphp


<!-- Menu -->
<ul class="px-2 py-4 space-y-1 text-sm">

   <li>
      <a href="{{ route('dashboard') }}"
         class="flex items-center gap-3 px-4 py-2 rounded-lg transition
           {{ request()->routeIs('dashboard') ? $activeClass : $inactiveClass }}">

         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
         </svg>

         Dashboard
      </a>
   </li>

</ul>