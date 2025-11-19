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
    <?php $__env->slot('title', 'Staff Registration'); ?>

    <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8">
        <div class="mx-auto text-gray-900 dark:text-gray-100">

            <!-- Staff Registration Form -->
            <form method="POST" action="<?php echo e(route('admin.staff.store')); ?>" x-init="init();
            enableSequentialInput();
            $nextTick(() => focusFirstInput());">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <!-- Staff Code -->
                    <div>
                        <label for="code" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Staff Code <span class="text-red-500">*</span>
                        </label>
                        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'code','placeholder' => 'Enter staff code','required' => true,'class' => 'w-full hover:border-purple-400 transition duration-150']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
                    </div>

                    <!-- Staff Name -->
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Staff Name <span class="text-red-500">*</span>
                        </label>
                        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'name','placeholder' => 'Enter staff name','required' => true,'class' => 'w-full hover:border-purple-400 transition duration-150']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label for="address" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Address <span class="text-red-500">*</span>
                        </label>
                        <textarea name="address" rows="3" placeholder="Enter full address" required
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2
                            focus:outline-none focus:ring-2 focus:ring-purple-600
                            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100
                            hover:border-purple-400 transition duration-150"><?php echo e(old('address')); ?></textarea>
                    </div>

                    <!-- Phone No -->
                    <div>
                        <label for="phone_no" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Phone No. <span class="text-red-500">*</span>
                        </label>
                        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'phone_no','placeholder' => 'Enter phone number','pattern' => '[0-9+\-\s]{7,15}','title' => 'Please enter a valid phone number','required' => true,'class' => 'w-full hover:border-purple-400 transition duration-150']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $attributes = $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8)): ?>
<?php $component = $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8; ?>
<?php unset($__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8); ?>
<?php endif; ?>
                    </div>

                </div>

                <!-- Save Button -->
                <div class="mt-6 text-right">
                    <button id="submitBtn" type="submit"
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
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/admin/staff/create.blade.php ENDPATH**/ ?>