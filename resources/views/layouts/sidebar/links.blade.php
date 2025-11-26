<ul class="mt-6">
    <li class="relative px-6 py-3">
        <span
            class="{{ request()->routeIs('dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
            aria-hidden="true"></span>
        <a href="{{ route('dashboard') }}"
            class="{{ request()->routeIs('dashboard') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} inline-flex w-full items-start text-sm font-semibold transition-colors duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard">
                <rect width="7" height="9" x="3" y="3" rx="1" />
                <rect width="7" height="5" x="14" y="3" rx="1" />
                <rect width="7" height="9" x="14" y="12" rx="1" />
                <rect width="7" height="5" x="3" y="16" rx="1" />
            </svg>
            <span class="ml-2 transition-all duration-200 origin-left"
                :class="isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                Dashboard
            </span> </a>
    </li>

    @php
        $user = auth()->user();
    @endphp

    @if ($user && $user->role === 'admin')
        {{-- Admin Sidebar --}}
        @include('layouts.sidebar.admin-links')
    @elseif ($user && $user->role === 'merchant')
        {{-- Merchant Sidebar --}}
        @include('layouts.sidebar.merchant-links')
    @endif

</ul>
