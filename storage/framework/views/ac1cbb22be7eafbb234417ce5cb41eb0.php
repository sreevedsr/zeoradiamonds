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
        Manage Diamond Certificates
    </h2>

    <!-- Success Message -->
    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded-md max-w-4xl mx-auto">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Assign Certificate Section -->
    <div class="p-6 mb-8 bg-white dark:bg-gray-800 rounded-lg shadow max-w-5xl mx-auto">
        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-6">
            Assign a Diamond Certificate
        </h3>

        <form method="POST" action="<?php echo e(route('admin.cards.assign')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="merchant_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Select Merchant
                    </label>
                    <select name="merchant_id" id="merchant_id" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <option value="" disabled selected>-- Choose a Merchant --</option>
                        <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($merchant->id); ?>">
                                <?php echo e($merchant->name); ?> (<?php echo e($merchant->business_name); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label for="card_number" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Card Number
                    </label>
                    <input type="text" name="card_number" id="card_number" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>

                <div>
                    <label for="carat_weight" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Carat Weight
                    </label>
                    <input type="number" step="0.01" name="carat_weight" id="carat_weight" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>

                <div>
                    <label for="clarity" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Clarity
                    </label>
                    <input type="text" name="clarity" id="clarity" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>

                <div>
                    <label for="color" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Color
                    </label>
                    <input type="text" name="color" id="color" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>

                <div>
                    <label for="cut" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Cut
                    </label>
                    <input type="text" name="cut" id="cut" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700
                           focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-150">
                    Assign Certificate
                </button>
            </div>
        </form>
    </div>

    <!-- Diamond Certificates Table -->
    <?php if (isset($component)) { $__componentOriginal7d9f6e0b9001f5841f72577781b2d17f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f = $attributes; } ?>
<?php $component = App\View\Components\Table::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Table::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Card Number', 'Merchant', 'Carat', 'Clarity', 'Color', 'Cut', 'Assigned Date']),'from' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->firstItem()),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->lastItem()),'total' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->total()),'pages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(range(1, $cards->lastPage())),'current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->currentPage()),'route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.cards.index')),'searchPlaceholder' => 'Search certificates...']); ?>

    <?php $__empty_1 = true; $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
            <td class="px-4 py-3"><?php echo e($card->card_number); ?></td>
            <td class="px-4 py-3"><?php echo e($card->merchant ? $card->merchant->name : '—'); ?></td>
            <td class="px-4 py-3"><?php echo e($card->carat_weight); ?></td>
            <td class="px-4 py-3"><?php echo e($card->clarity); ?></td>
            <td class="px-4 py-3"><?php echo e($card->color); ?></td>
            <td class="px-4 py-3"><?php echo e($card->cut); ?></td>
            <td class="px-4 py-3"><?php echo e($card->created_at->format('d M Y')); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="7" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                No certificates found.
            </td>
        </tr>
    <?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f)): ?>
<?php $attributes = $__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f; ?>
<?php unset($__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d9f6e0b9001f5841f72577781b2d17f)): ?>
<?php $component = $__componentOriginal7d9f6e0b9001f5841f72577781b2d17f; ?>
<?php unset($__componentOriginal7d9f6e0b9001f5841f72577781b2d17f); ?>
<?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/cards/assign.blade.php ENDPATH**/ ?>