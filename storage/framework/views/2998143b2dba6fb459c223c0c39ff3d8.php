<!-- Global Loader (Diamond Animation) -->
<div x-data="pageTransition()" x-init="init()" x-show="show" x-transition.opacity
    class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-gradient-to-br from-purple-50 via-white to-purple-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 pointer-events-auto">

    <div class="relative">
        <!-- Diamond Shape -->
        <svg class="w-16 h-16 animate-[spin_2s_linear_infinite]" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <polygon points="50,5 95,35 75,95 25,95 5,35"
                fill="url(#diamond-gradient)"
                stroke="#9333EA"
                stroke-width="3"
                stroke-linejoin="round" />
            <defs>
                <linearGradient id="diamond-gradient" x1="0" x2="1" y1="0" y2="1">
                    <stop offset="0%" stop-color="#A855F7" />
                    <stop offset="50%" stop-color="#C084FC" />
                    <stop offset="100%" stop-color="#E9D5FF" />
                </linearGradient>
            </defs>
        </svg>

        <!-- Glow Effect -->
        <div class="absolute inset-0 blur-2xl bg-purple-400/30 rounded-full animate-pulse-slow"></div>
    </div>

    <p class="mt-6 text-gray-700 dark:text-gray-300 font-medium animate-pulse-slow">
        Refining brilliance...
    </p>
</div>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/components/loader.blade.php ENDPATH**/ ?>