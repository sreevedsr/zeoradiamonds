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
    <?php $__env->slot('title', 'Zeeyame - Add Card Details'); ?>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Card Details
    </h2>

    <div class="space-y-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Card Form Section -->
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="text-gray-900 dark:text-gray-100">
                <?php if(session('success')): ?>
                    <div class="mb-4 text-green-500 font-semibold">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('forms.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="mb-4">
                        <label for="card_title" class="block text-sm font-medium">Card Title</label>
                        <input type="text" name="card_title" id="card_title"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="card_description" class="block text-sm font-medium">Card Description</label>
                        <textarea name="card_description" id="card_description" rows="3"
                                  class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                                  required></textarea>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Save
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/forms/index.blade.php ENDPATH**/ ?>