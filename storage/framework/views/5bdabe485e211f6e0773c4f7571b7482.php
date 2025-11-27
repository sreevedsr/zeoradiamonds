<?php if(auth()->guard()->check()): ?>
    <div x-data="{ open: false }" class="relative p-4 pb-0 flex flex-col items-center md:items-stretch"
        x-effect="if (isSidebarCollapsed) open = false">
        <!-- Profile Button -->
        <button @click="open = !open"
            class="mt-6 inline-flex items-center rounded-md text-sm font-semibold text-gray-800 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-white/10 dark:text-white dark:hover:bg-white/20 w-full"
            :class="isSidebarCollapsed
                ?
                'justify-center h-14 w-14 p-0 bg-transparent hover:bg-gray-200/40 dark:hover:bg-white/10 rounded-full' :
                'justify-between h-16 px-4 py-2 gap-x-3 hover:bg-gray-200 dark:hover:bg-white/20 rounded-md'">
            <!-- Profile Info -->
            <div class="flex items-center transition-all duration-300 w-full"
                :class="isSidebarCollapsed ? 'justify-center' : 'justify-start'">
                <!-- Avatar -->
                

                <div class="ml-3 flex flex-col justify-center text-left overflow-hidden transition-all duration-300"
                    :class="isSidebarCollapsed ? 'hidden' : 'block'">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                        <?php echo e(Auth::user()->name); ?>

                    </span>
                    <span class="text-xs text-gray-600 dark:text-gray-300 truncate">
                        <?php echo e(Auth::user()->role ?? Auth::user()->merchant_code); ?>

                    </span>
                </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2"
                class="ml-auto transform text-gray-700 transition-all duration-300 dark:text-gray-300"
                :class="{
                    'hidden': isSidebarCollapsed,
                    'rotate-0': open,
                    'rotate-180': !open
                }">
                <path d="m7 10 5 5 5-5" />
            </svg>
        </button>

        <!-- Dropdown -->
        <div x-show="open && !isSidebarCollapsed" @click.outside="open = false"
            x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
            class="absolute bottom-16 left-4 right-4 z-50 w-auto rounded-md border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800 mb-2">
            <div class="p-3 border-b border-gray-100 dark:border-gray-700">
                <p class="text-sm font-semibold text-gray-800 dark:text-white"><?php echo e(Auth::user()->name); ?></p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    <?php echo e(Auth::user()->role ?? Auth::user()->merchant_code); ?>

                </p>
            </div>

            <div class="p-2">
                <a href="<?php echo e(route('profile.edit')); ?>"
                    class="block rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                    Edit Profile
                </a>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                        class="w-full text-left rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/layouts/sidebar/profile.blade.php ENDPATH**/ ?>