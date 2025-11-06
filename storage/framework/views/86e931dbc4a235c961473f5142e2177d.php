<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo e($title ?? 'Zeora Diamonds'); ?></title> <!-- keeps dynamic title -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">

    <!-- Tailwind CSS -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <!-- AlpineJS -->
    
    <script src="<?php echo e(asset('assets/js/init-alpine.js')); ?>"></script>

    <!-- Charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="<?php echo e(asset('assets/js/charts-lines.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/charts-pie.js')); ?>" defer></script>
</head>
<body
    class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 w-screen overflow-x-hidden">

    <div class="flex min-h-screen w-full">

        <!-- Fixed Sidebar -->
            <?php echo $__env->make('layouts.sidebar.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 md:ml-64 min-w-0">
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <main class="flex-1 overflow-y-auto px-6 py-6 transition-colors duration-300 h-screen">
                <?php echo e($slot); ?>

            </main>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/layouts/app.blade.php ENDPATH**/ ?>