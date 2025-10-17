<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo e($title ?? 'Zeeyame'); ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/tailwind.output.css')); ?>" />

    <!-- AlpineJS for interactivity -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="<?php echo e(asset('assets/js/init-alpine.js')); ?>"></script>

    <!-- Charts (optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="<?php echo e(asset('assets/js/charts-lines.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/charts-pie.js')); ?>" defer></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300">
    <div class="flex h-screen" :class="{ 'overflow-hidden': isSideMenuOpen }">

        <!-- Sidebar -->
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main content area -->
        <div class="flex flex-col flex-1 w-full">

            <!-- Navigation / Top bar -->
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Main content wrapper with shadow -->
            <main class="flex-1 overflow-y-auto p-6 transition-colors duration-300">
                <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 transition-colors duration-300">
                    <?php echo e($slot); ?>

                </div>
            </main>
        </div>
    </div>

    <!-- Optional: Modals -->
    <?php echo $__env->yieldPushContent('modals'); ?>

    <!-- Optional Footer -->
    
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/layouts/app.blade.php ENDPATH**/ ?>