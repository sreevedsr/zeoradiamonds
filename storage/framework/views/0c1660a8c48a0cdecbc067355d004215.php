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
    <?php $__env->slot('title', 'Zeeyame - Add Customer'); ?>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Customer
    </h2>

    <!-- Customer Form Section -->
    <div class="space-y-6">
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl text-gray-900 dark:text-gray-100">
                <?php if(session('success')): ?>
                    <div class="mb-4 text-green-500 font-semibold">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="mb-4 text-red-500 font-semibold">
                        <ul class="list-disc list-inside">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('customers.store')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?>

                    <!-- Customer Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Customer Name</label>
                        <input type="text" name="name"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter full name" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                        <input type="email" name="email"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter email address" required>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Phone Number</label>
                        <input type="text" name="phone"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter phone number" required>
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Address</label>
                        <textarea name="address"
                                  class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                                  placeholder="Enter full address" rows="3" required></textarea>
                    </div>

                    <!-- Optional: Other fields like city, state, etc. -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">City</label>
                        <input type="text" name="city"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter city" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">State</label>
                        <input type="text" name="state"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter state" required>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors duration-150">
                        Save Customer
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/customers/create.blade.php ENDPATH**/ ?>