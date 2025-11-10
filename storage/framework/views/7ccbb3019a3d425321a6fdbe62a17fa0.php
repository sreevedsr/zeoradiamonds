<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->slot('title', 'Merchant Marketplace'); ?>

    <!-- Grid of cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 " style="
    grid-template-columns: repeat(3, minmax(0, 1fr));
">
        <!-- Card 1 -->
        <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-2 font-semibold text-gray-600 dark:text-gray-300">
                Diamond ID: D-001
            </h4>
            <p class="text-gray-600 dark:text-gray-400 mb-2">
                Carat Weight: 1.5 ct
            </p>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Clarity: VS1 | Color: F
            </p>
            <button class="px-4 py-2 w-full text-white bg-purple-600 rounded hover:bg-purple-700">
                Request Stock
            </button>
        </div>

        <!-- Card 2 -->
        <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-2 font-semibold text-gray-600 dark:text-gray-300">
                Diamond ID: D-002
            </h4>
            <p class="text-gray-600 dark:text-gray-400 mb-2">
                Carat Weight: 2.0 ct
            </p>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Clarity: VVS2 | Color: D
            </p>
            <button class="px-4 py-2 w-full text-white bg-purple-600 rounded hover:bg-purple-700">
                Request Stock
            </button>
        </div>

        <!-- Card 3 -->
        <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-2 font-semibold text-gray-600 dark:text-gray-300">
                Diamond ID: D-003
            </h4>
            <p class="text-gray-600 dark:text-gray-400 mb-2">
                Carat Weight: 1.2 ct
            </p>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Clarity: SI1 | Color: G
            </p>
            <button class="px-4 py-2 w-full text-white bg-purple-600 rounded hover:bg-purple-700">
                Request Stock
            </button>
        </div>

        <!-- Card 4 -->
        <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-2 font-semibold text-gray-600 dark:text-gray-300">
                Diamond ID: D-004
            </h4>
            <p class="text-gray-600 dark:text-gray-400 mb-2">
                Carat Weight: 1.2 ct
            </p>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Clarity: SI1 | Color: G
            </p>
            <button class="px-4 py-2 w-full text-white bg-purple-600 rounded hover:bg-purple-700">
                Request Stock
            </button>
        </div>

        <!-- Add more cards as needed -->
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/merchant/cards/request-card.blade.php ENDPATH**/ ?>