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
    <?php $__env->slot('title', 'Zeeyame - Supplier Registration'); ?>

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Supplier Registration
    </h2>

    <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8">
        <div class="mx-auto text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            <?php if(session('success')): ?>
                <div class="mb-4 rounded-md border border-green-300 bg-green-100 p-3 text-green-700">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- Error Messages -->
            <?php if($errors->any()): ?>
                <div class="mb-4 rounded-md border border-red-300 bg-red-100 p-3 text-red-700">
                    <ul class="list-inside list-disc">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Supplier Registration Form -->
            <form method="POST" action="<?php echo e(route('admin.suppliers.store')); ?>">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Supplier Code -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Supplier Code <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="supplier_code" placeholder="Enter supplier code" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- Supplier Name -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Supplier Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" placeholder="Enter supplier name" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Address
                        </label>
                        <textarea name="address" rows="3" placeholder="Enter full address"
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"></textarea>
                    </div>

                    <!-- Phone No -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Phone No. <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="phone" placeholder="Enter phone number" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- State Code -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            State Code
                        </label>
                        <input type="text" name="state_code" placeholder="Enter state code"
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- State -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            State
                        </label>
                        <input type="text" name="state" placeholder="Enter state name"
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- GST No -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            GST No.
                        </label>
                        <input type="text" name="gst_no" placeholder="Enter GST number"
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>
                </div>

                <!-- Save Button -->
                <div class="mt-6 text-right">
                    <button type="submit"
                        class="rounded-md bg-purple-600 px-5 py-2 font-medium text-white
                               hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Save
                    </button>
                </div>
            </form>
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/suppliers/create.blade.php ENDPATH**/ ?>