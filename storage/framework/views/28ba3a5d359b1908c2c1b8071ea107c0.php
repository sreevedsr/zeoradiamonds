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
    <?php $__env->slot('title', 'Manage Rates'); ?>

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Gold & Diamond Rates
    </h2>

    <?php if(session('success')): ?>
        <div class="mb-4 text-green-600 dark:text-green-400"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Gold Rate Section -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-yellow-600">Gold Rate</h3>
            <p class="mb-2 text-gray-600 dark:text-gray-300">
                Current:
                <span class="font-bold"><?php echo e($latestGold->rate ?? 'Not Set'); ?> ₹</span>
            </p>
            <form action="<?php echo e(route('admin.rates.gold.store')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <input type="number" name="rate" step="0.01" required
                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md px-3 py-2"
                    placeholder="Enter new gold rate">
                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                    Update Gold Rate
                </button>
            </form>

            <h4 class="mt-6 mb-2 font-semibold text-gray-700 dark:text-gray-200">Recent Updates</h4>
            <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                <?php $__currentLoopData = $goldRates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($rate->rate); ?> ₹ — <span class="text-xs"><?php echo e($rate->created_at->diffForHumans()); ?></span></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>

        <!-- Diamond Rate Section -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-blue-600">Diamond Rate</h3>
            <p class="mb-2 text-gray-600 dark:text-gray-300">
                Current:
                <span class="font-bold"><?php echo e($latestDiamond->rate ?? 'Not Set'); ?> ₹</span>
            </p>
            <form action="<?php echo e(route('admin.rates.diamond.store')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <input type="number" name="rate" step="0.01" required
                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md px-3 py-2"
                    placeholder="Enter new diamond rate">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Update Diamond Rate
                </button>
            </form>

            <h4 class="mt-6 mb-2 font-semibold text-gray-700 dark:text-gray-200">Recent Updates</h4>
            <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                <?php $__currentLoopData = $diamondRates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($rate->rate); ?> ₹ — <span class="text-xs"><?php echo e($rate->created_at->diffForHumans()); ?></span></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/rates/index.blade.php ENDPATH**/ ?>