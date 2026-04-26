<ul class="px-3 py-4 space-y-2 text-sm">
    @foreach ($menu as $item)
        @if ($item['type'] === 'separator')
            @if ($hasRequiredRole($item['requireRole'] ?? null))
                <li class="my-3 border-t border-gray-200"></li>
            @endif
        @elseif ($item['type'] === 'single')
            @if ($hasRequiredRole($item['requireRole'] ?? null))
                <li>
                    <a href="{{ route($item['route'], $item['routeParams'] ?? []) }}"
                        class="flex items-center px-4 py-2.5 rounded-lg transition
                       {{ $isRouteActive($item['routePattern']) ? $activeClass : $inactiveClass }}">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endif
        @elseif ($item['type'] === 'multi')
            @if ($hasRequiredRole($item['requireRole'] ?? null))
                <li x-data="{ open: {{ $isRouteActive($item['routePattern']) ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg transition
                        {{ $isRouteActive($item['routePattern']) ? $activeClass : $inactiveClass }}">
                        <span>{{ $item['label'] }}</span>
                        <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <ul x-show="open" x-collapse class="mt-1 ml-4 space-y-1">
                        @foreach ($item['items'] as $subitem)
                            @if ($hasRequiredRole($subitem['requireRole'] ?? null))
                                <li>
                                    <a href="{{ route($subitem['route'], $subitem['routeParams'] ?? []) }}"
                                        class="block px-4 py-2 rounded-md transition {{ $isRouteActive($subitem['routePattern']) ? $activeClass : $inactiveClass }}">
                                        {{ $subitem['label'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
        @endif
    @endforeach
</ul>
