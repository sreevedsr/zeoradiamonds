<!-- Desktop Sidebar -->
<div class="hidden w-64 flex-shrink-0 overflow-y-auto bg-white dark:bg-gray-800 md:block">
    <div class="flex h-full flex-col justify-between bg-white py-4 text-gray-500 dark:bg-gray-800 dark:text-gray-400">
        <div>
            <!-- Logo -->
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                Zeora Diamonds
            </a>

            @include('layouts.sidebar.links')
        </div>

        @include('layouts.sidebar.profile')
    </div>
</div>

<!-- Mobile Sidebar -->
<div class="fixed inset-y-0 z-20 mt-16 flex w-64 flex-col justify-between overflow-y-auto bg-white py-4 text-gray-500 dark:bg-gray-800 dark:text-gray-400 md:hidden"
    x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20"
    @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">

    <div>
        <!-- Logo -->
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Zeora Diamonds
        </a>

        @include('layouts.sidebar.links')
    </div>

    @include('layouts.sidebar.profile')
</div>
