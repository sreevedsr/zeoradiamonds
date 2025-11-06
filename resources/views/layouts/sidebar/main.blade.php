<!-- Desktop Sidebar -->
<div
    class="sidebar hidden fixed top-0 left-0 h-screen flex-shrink-0 bg-white dark:bg-gray-800
           md:flex flex-col justify-between py-4 border-r border-gray-200 dark:border-gray-700
           transition-all duration-300 ease-in-out"
    :class="isSidebarCollapsed ? 'w-20' : 'w-64'"
>
    <div class="flex-1 overflow-y-auto">
        <!-- Logo -->
        <a
            class="ml-6 mt-4 text-lg font-bold text-gray-800 dark:text-gray-200 transition-opacity duration-200"
            :class="isSidebarCollapsed ? 'opacity-0 pointer-events-none' : 'opacity-100'"
            href="#"
        >
            Zeora Diamonds
        </a>

        @include('layouts.sidebar.links')
    </div>

    <!-- Profile fixed at bottom -->
    <div>
        @include('layouts.sidebar.profile')
    </div>
</div>

<!-- Mobile Sidebar -->
<div
    class="fixed inset-y-0 z-20 mt-16 flex w-64 flex-col justify-between bg-white dark:bg-gray-800
           dark:text-gray-400 md:hidden py-4 border-r border-gray-200 dark:border-gray-700"
    x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform -translate-x-20"
    @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu"
    x-init="$watch('isSideMenuOpen', value => document.body.classList.toggle('overflow-hidden', value))"
>
    <div class="flex-1 overflow-y-auto py-4">
        <!-- Logo -->
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Zeora Diamonds
        </a>

        @include('layouts.sidebar.links')
    </div>

    <!-- Profile fixed at bottom -->
    <div class="border-t border-gray-200 dark:border-gray-700">
        @include('layouts.sidebar.profile')
    </div>
</div>
