<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo e($title ?? 'Zeeyame'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/tailwind.output.css')); ?>" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="<?php echo e(asset('assets/js/init-alpine.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <div class="flex h-screen" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Sidebar -->
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="flex flex-col flex-1 w-full">
            <!-- Navigation -->
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Main content -->
            <main class="h-full overflow-y-auto p-6">
                <?php echo e($slot); ?>

            </main>
        </div>
    </div>
    <?php echo $__env->yieldPushContent('modals'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/layouts/app.blade.php ENDPATH**/ ?>