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
    <?php $__env->slot('title', 'Zeeyame - Add Diamond Certificate'); ?>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Diamond Certificate
    </h2>

    <div class="space-y-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Diamond Certificate Form Section -->
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="text-gray-900 dark:text-gray-100">
                <?php if(session('success')): ?>
                    <div class="mb-4 text-green-500 font-semibold">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('cards.store')); ?>">
                    <?php echo csrf_field(); ?>

                    <!-- Certificate Holder Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Certificate Holder Name</label>
                        <input type="text" name="holder_name"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter full name" required>
                    </div>

                    <!-- Certificate ID / Number -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Certificate ID</label>
                        <input type="text" name="certificate_id"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter unique certificate ID" required>
                    </div>

                    <!-- Diamond Type -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Diamond Type</label>
                        <input type="text" name="diamond_type"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="e.g., Round, Princess, Emerald" required>
                    </div>

                    <!-- Carat Weight -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Carat Weight</label>
                        <input type="number" step="0.01" name="carat_weight"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="e.g., 1.25" required>
                    </div>

                    <!-- Clarity -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Clarity</label>
                        <input type="text" name="clarity"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="e.g., VVS1, VS2" required>
                    </div>

                    <!-- Color -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Color</label>
                        <input type="text" name="color"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="e.g., D, E, F" required>
                    </div>

                    <!-- Cut -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Cut</label>
                        <input type="text" name="cut"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="e.g., Excellent, Very Good" required>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Save Certificate
                    </button>
                </form>
            </div>
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/cards/index.blade.php ENDPATH**/ ?>