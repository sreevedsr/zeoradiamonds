<!-- resources/views/components/alert-toast.blade.php -->
<div
    x-data="{ show: true }"
    x-show="show"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="translate-x-full opacity-0 scale-90"
    x-transition:enter-end="translate-x-0 opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-400"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0 scale-95"
    x-init="setTimeout(() => show = false, 5000)"
    class="fixed top-8 right-8 z-[9999] flex items-center gap-3 px-8 py-5 rounded-lg shadow-xl backdrop-blur
        <?php if($type === 'success'): ?>
            bg-green-50 border-green-500 text-green-900
            dark:bg-green-900/20 dark:text-green-200 dark:border-green-400
        <?php elseif($type === 'error'): ?>
            bg-red-50 border-red-500 text-red-900
            dark:bg-red-900/20 dark:text-red-200 dark:border-red-400
        <?php else: ?>
            bg-gray-100 border-gray-400 text-gray-900
            dark:bg-gray-800/90 dark:text-gray-100 dark:border-gray-500
        <?php endif; ?>
        transition-all duration-500 transform"
    style="box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);"
>
    <!-- Animated Icon Glow Wrapper -->
    <div class="flex-shrink-0">
        <?php if($type === 'success'): ?>
            <div class="p-2 rounded-full bg-green-100 dark:bg-green-700/50 animate-pulse">
                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        <?php elseif($type === 'error'): ?>
            <div class="p-2 rounded-full bg-red-100 dark:bg-red-700/50 animate-pulse">
                <svg class="w-6 h-6 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        <?php else: ?>
            <div class="p-2 rounded-full bg-gray-100 dark:bg-gray-700">
                <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20h.01" />
                </svg>
            </div>
        <?php endif; ?>
    </div>

    <!-- Message Section -->
    <div class="flex flex-col">
        <p class="text-base font-semibold tracking-tight">
            <?php if($type === 'success'): ?> Success
            <?php elseif($type === 'error'): ?> Error
            <?php else: ?> Notice
            <?php endif; ?>
        </p>
        <p class="text-sm font-medium leading-snug opacity-90">
            <?php echo e($message); ?>

        </p>
    </div>

    <!-- Close Button -->
    <button
        @click="show = false"
        class="ml-auto text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors duration-200"
        aria-label="Close notification"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/components/alert-toast.blade.php ENDPATH**/ ?>