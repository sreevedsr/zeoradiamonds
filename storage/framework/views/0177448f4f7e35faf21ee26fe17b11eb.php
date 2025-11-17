<!-- Desktop Sidebar -->
<div class="sidebar hidden fixed top-0 left-0 h-screen flex-shrink-0 bg-white dark:bg-gray-800
           md:flex flex-col justify-between py-4 border-r border-gray-200 dark:border-gray-700
           transition-all duration-300 ease-in-out cursor-pointer"
    :class="isSidebarCollapsed ? 'w-20 pointer-events-auto' : 'w-64 cursor-default'"
    @click="if (isSidebarCollapsed) { isSidebarCollapsed = false; $nextTick(() => { $focus.first(); }); }">
    <div class="flex-1 overflow-y-auto transition-all duration-300"
        :class="isSidebarCollapsed ? 'pointer-events-none select-none' : 'pointer-events-auto select-auto'">
        <!-- Logo -->
        <template x-if="!isSidebarCollapsed">
            <a class="ml-6 mt-4 text-lg font-bold text-gray-800 dark:text-gray-200 block" href="#">
                Zeora Diamonds
            </a>
        </template>

        <!-- Sidebar Links -->
        <div class="transition-opacity duration-300"
            :class="isSidebarCollapsed ? 'opacity-50 select-none' : 'opacity-100 select-auto'">
            <?php echo $__env->make('layouts.sidebar.links', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <!-- Profile fixed at bottom -->
    <div class="transition-opacity duration-300 dark:border-gray-700"
        :class="isSidebarCollapsed ? 'opacity-50 select-none pointer-events-none' : 'opacity-100 pointer-events-auto'">
        <?php echo $__env->make('layouts.sidebar.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>


<!-- Mobile Sidebar -->
<div class="fixed inset-y-0 z-30 flex w-80 flex-col justify-between bg-white dark:bg-gray-800
           dark:text-gray-400 md:hidden py-4 border-r border-gray-200 dark:border-gray-700"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu" x-init="$watch('isSideMenuOpen', value => document.body.classList.toggle('overflow-hidden', value))">
    <div class="flex-1 overflow-y-auto py-4">
        <!-- Logo -->
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Zeora Diamonds
        </a>

        <?php echo $__env->make('layouts.sidebar.links', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Profile fixed at bottom -->
    <div class=" dark:border-gray-700">
        <?php echo $__env->make('layouts.sidebar.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/layouts/sidebar/main.blade.php ENDPATH**/ ?>