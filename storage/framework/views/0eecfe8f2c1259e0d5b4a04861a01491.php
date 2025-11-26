<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? 'Zeora Diamonds'); ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">


    <!-- Tailwind CSS -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <!-- AlpineJS -->
    <script src="<?php echo e(asset('assets/js/init-alpine.js')); ?>"></script>
</head>

<body
    class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 w-screen overflow-x-hidden">

    <div class="flex min-h-screen w-full">

        <!-- Fixed Sidebar -->
        <?php echo $__env->make('layouts.sidebar.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 min-w-0 transition-all duration-300 ease-in-out"
            :class="isSidebarCollapsed ? 'md:ml-20' : 'md:ml-64'">
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <main class="flex-1 overflow-y-auto px-6 pt-4 transition-colors duration-300">
                <?php echo e($slot); ?>

            </main>
        </div>
    </div>
    <!-- Global Toast Messages -->
    <?php if(session('success')): ?>
        <?php if (isset($component)) { $__componentOriginal2b06ec262d265f70cd7e1342bf9df9f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b06ec262d265f70cd7e1342bf9df9f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert-toast','data' => ['type' => 'success','message' => session('success')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert-toast'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'success','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('success'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b06ec262d265f70cd7e1342bf9df9f0)): ?>
<?php $attributes = $__attributesOriginal2b06ec262d265f70cd7e1342bf9df9f0; ?>
<?php unset($__attributesOriginal2b06ec262d265f70cd7e1342bf9df9f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b06ec262d265f70cd7e1342bf9df9f0)): ?>
<?php $component = $__componentOriginal2b06ec262d265f70cd7e1342bf9df9f0; ?>
<?php unset($__componentOriginal2b06ec262d265f70cd7e1342bf9df9f0); ?>
<?php endif; ?>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <?php if (isset($component)) { $__componentOriginal2b06ec262d265f70cd7e1342bf9df9f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b06ec262d265f70cd7e1342bf9df9f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert-toast','data' => ['type' => 'error','message' => $errors->first()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert-toast'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'error','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->first())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b06ec262d265f70cd7e1342bf9df9f0)): ?>
<?php $attributes = $__attributesOriginal2b06ec262d265f70cd7e1342bf9df9f0; ?>
<?php unset($__attributesOriginal2b06ec262d265f70cd7e1342bf9df9f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b06ec262d265f70cd7e1342bf9df9f0)): ?>
<?php $component = $__componentOriginal2b06ec262d265f70cd7e1342bf9df9f0; ?>
<?php unset($__componentOriginal2b06ec262d265f70cd7e1342bf9df9f0); ?>
<?php endif; ?>
    <?php endif; ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/layouts/app.blade.php ENDPATH**/ ?>