<ul class="mt-6">
    <li class="relative px-6 py-3">
        <span
            class="{{ request()->routeIs('dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
            aria-hidden="true"></span>
        <a href="{{ route('dashboard') }}"
            class="{{ request()->routeIs('dashboard') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} inline-flex w-full items-start text-sm font-semibold transition-colors duration-150">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
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
