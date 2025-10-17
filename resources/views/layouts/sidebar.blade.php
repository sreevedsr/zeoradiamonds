<!-- Desktop Sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <!-- Logo -->
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Zeeyame
        </a>

        <!-- Navigation -->
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span class="{{ request()->routeIs('dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                   {{ request()->routeIs('dashboard') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>

        <ul>
            @can('view-forms')
            <li class="relative px-6 py-3">
                <span class="{{ request()->routeIs('forms.*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                <a href="{{ route('forms.index') }}"
                   class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                   {{ request()->routeIs('forms.*') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="ml-4">Forms</span>
                </a>
            </li>
            @endcan

            @can('view-cards')
            <li class="relative px-6 py-3">
                <span class="{{ request()->routeIs('cards.*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                <a href="{{ route('cards.index') }}"
                   class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                   {{ request()->routeIs('cards.*') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="ml-4">Cards</span>
                </a>
            </li>
            @endcan
        </ul>

        @can('create-account')
        <div class="px-6 my-6">
            <button class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Create account
                <span class="ml-2" aria-hidden="true">+</span>
            </button>
        </div>
        @endcan
    </div>
</aside>

<!-- Mobile Sidebar -->
<div x-show="isSideMenuOpen" x-transition.opacity class="fixed inset-0 z-10 bg-black bg-opacity-50 md:hidden"></div>

<aside class="fixed inset-y-0 z-20 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
       x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
       x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
       @keydown.escape="closeSideMenu">

    <div class="py-4 text-gray-500 dark:text-gray-400">
        <!-- Logo -->
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Zeeyame
        </a>

        <!-- Navigation -->
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                   {{ request()->routeIs('dashboard') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                    Dashboard
                </a>
            </li>
        </ul>

        <ul>
            @can('view-forms')
            <li class="relative px-6 py-3">
                <a href="{{ route('forms.index') }}"
                   class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                   {{ request()->routeIs('forms.*') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                    Forms
                </a>
            </li>
            @endcan

            @can('view-cards')
            <li class="relative px-6 py-3">
                <a href="{{ route('cards.index') }}"
                   class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                   {{ request()->routeIs('cards.*') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                    Cards
                </a>
            </li>
            @endcan
        </ul>

        @can('create-account')
        <div class="px-6 my-6">
            <button class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Create account
                <span class="ml-2" aria-hidden="true">+</span>
            </button>
        </div>
        @endcan
    </div>
</aside>
