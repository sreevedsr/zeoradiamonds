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
    <?php $__env->slot('title', 'Zeeyame - Diamond Certificates'); ?>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Request Diamond Certificates
    </h2>

    <!-- Success Message -->
    <?php if(session('success')): ?>
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded max-w-4xl mx-auto">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Request Specific Diamond Form -->
    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg max-w-4xl mx-auto mb-8">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Request a Specific Diamond</h3>
        <form action="<?php echo e(route('merchant.cards.request')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>

            <div>
                <label for="holder_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Holder
                    Name</label>
                <input type="text" name="holder_name" id="holder_name" required
                    class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
            </div>

            <div>
                <label for="diamond_type"
                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Diamond Type</label>
                <input type="text" name="diamond_type" id="diamond_type" required
                    class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="carat_weight"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Carat Weight</label>
                    <input type="number" step="0.01" name="carat_weight" id="carat_weight" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div>
                    <label for="clarity"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Clarity</label>
                    <input type="text" name="clarity" id="clarity" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div>
                    <label for="color"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Color</label>
                    <input type="text" name="color" id="color" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
            </div>

            <div>
                <label for="cut"
                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Cut</label>
                <input type="text" name="cut" id="cut" required
                    class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    Submit Request
                </button>
            </div>
        </form>
    </div>

    <!-- Marketplace Grid -->
    <div class="max-w-7xl mx-auto grid">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Diamond Marketplace</h3>
        <div class="grid grid-cols-3 sm:grid-cols-2 gap-6">
            <?php
                $dummyDiamonds = [
                    [
                        'diamond_type' => 'Round Brilliant',
                        'carat_weight' => 1.2,
                        'color' => 'D',
                        'clarity' => 'VVS1',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                    [
                        'diamond_type' => 'Princess Cut',
                        'carat_weight' => 0.8,
                        'color' => 'F',
                        'clarity' => 'VS2',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                    [
                        'diamond_type' => 'Emerald Cut',
                        'carat_weight' => 1.5,
                        'color' => 'G',
                        'clarity' => 'SI1',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                    [
                        'diamond_type' => 'Oval Cut',
                        'carat_weight' => 1.0,
                        'color' => 'H',
                        'clarity' => 'VS1',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                    [
                        'diamond_type' => 'Cushion Cut',
                        'carat_weight' => 0.9,
                        'color' => 'E',
                        'clarity' => 'VVS2',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                    [
                        'diamond_type' => 'Asscher Cut',
                        'carat_weight' => 1.3,
                        'color' => 'F',
                        'clarity' => 'SI2',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                ];
            ?>

            <?php $__currentLoopData = $dummyDiamonds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diamond): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden flex flex-col">
                    <!-- Header -->
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200">
                            <?php echo e($diamond['diamond_type']); ?></h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo e($diamond['carat_weight']); ?> ct |
                            <?php echo e($diamond['color']); ?> | <?php echo e($diamond['clarity']); ?></p>
                    </div>

                    <!-- Image -->
                    <div class="flex justify-center items-center p-4 h-32">
                        <img src="<?php echo e($diamond['image_url']); ?>" alt="Diamond" class="h-full object-contain">
                    </div>

                    <!-- Form -->
                    <div class="p-4">
                        <form action="#" method="POST" class="space-y-3">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="diamond_id" value="dummy">

                            

                            <div class="flex justify-start">
                                <button type="submit"
                                    class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/merchants/request-cards.blade.php ENDPATH**/ ?>