<!-- Desktop Sidebar -->
<div class="hidden fixed top-0 left-0 h-screen w-64 flex-shrink-0 bg-white dark:bg-gray-800 md:flex flex-col justify-between py-4">
    <div class="flex-1 overflow-y-auto">
        <!-- Logo -->
        <a class="ml-6 mt-4 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Zeora Diamonds
        </a>

        @include('layouts.sidebar.links')
    </div>

    <!-- Profile fixed at bottom -->
    <div class=" dark:border-gray-700">
        @include('layouts.sidebar.profile')
    </div>
</div>

<!-- Mobile Sidebar -->
<div
    class="fixed inset-y-0 z-20 mt-16 flex w-64 flex-col justify-between bg-white dark:bg-gray-800 dark:text-gray-400 md:hidden py-4"
    x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
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
    <div class="dark:border-gray-700 border-t border-gray-200">
        @include('layouts.sidebar.profile')
    </div>
</div>

