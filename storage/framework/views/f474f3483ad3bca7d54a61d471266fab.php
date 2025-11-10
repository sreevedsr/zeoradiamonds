<header
    class="sticky top-0 z-20 pt-7 pb-4 bg-white dark:bg-gray-900 shadow-md dark:shadow-gray-900 transition-all duration-300">

    <div class="flex items-center justify-between h-full px-6 text-purple-600 dark:text-purple-300">

        <!-- Left Section: Sidebar Toggle + Page Title -->
        <div class="flex items-center space-x-3">
            <!-- Desktop Sidebar Toggle Button -->
            <button class="hidden md:block p-2 rounded-md focus:outline-none transition-transform duration-300"
                @click="toggleSidebar" aria-label="Toggle desktop sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-panel-right rotate-180">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M15 3v18" />
                </svg>
            </button>

            <!-- Mobile Sidebar Toggle Button -->
            <button class="md:hidden p-2 rounded-md focus:outline-none transition-transform duration-300"
                @click="toggleMobileSidebar" aria-label="Toggle mobile sidebar">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <h1
                class="text-xl sm:text-2xl md:text-3xl font-semibold text-gray-800 dark:text-gray-100  max-w-[60vw] sm:max-w-none">
                <?php echo e($title ?? 'Dashboard'); ?>

            </h1>
        </div>

        <!-- Right Section -->
        
    </div>
</header>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>