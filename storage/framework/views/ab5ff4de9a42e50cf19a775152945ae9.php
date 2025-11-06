
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
    <?php $__env->slot('title', 'Upload Product Purchase Details'); ?>

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Upload Product Purchase Details
    </h2>

    
    <?php if(session('success')): ?>
        <div class="mb-4 rounded-md border border-green-300 bg-green-100 p-3 text-green-700">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <div class="mb-4 rounded-md border border-red-300 bg-red-100 p-3 text-red-700">
            <strong class="block mb-1">Please fix the following errors:</strong>
            <ul class="list-inside list-disc">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <div class="space-y-6">

        
        <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8 text-gray-900 dark:text-gray-100">
            <form method="POST" action="<?php echo e(route('admin.products.store')); ?>" enctype="multipart/form-data"
                x-data="purchaseForm()"
                x-init="init(); enableSequentialInput(); $nextTick(() => focusFirstInput());">
                <?php echo csrf_field(); ?>

                
                <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="date" value="<?php echo e(old('date', now()->toDateString())); ?>" readonly
                            class="input-field w-full cursor-not-allowed rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-gray-700 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Supplier (Name / Code) <span class="text-red-500">*</span>
                        </label>
                        <select name="supplier" x-model="supplier"
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                            <option value="">-- Select supplier --</option>
                            <?php $__currentLoopData = $suppliers ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($s->id); ?>" <?php if(old('supplier') == $s->id): echo 'selected'; endif; ?>>
                                    <?php echo e($s->name); ?> / <?php echo e($s->code ?? $s->id); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Invoice No. <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="invoice_no" x-model="invoice_no" value="<?php echo e(old('invoice_no')); ?>"
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Salesman <span class="text-red-500">*</span>
                        </label>
                        <select name="salesman" x-model="salesman"
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                            <option value="">-- Select salesman --</option>
                            <?php $__currentLoopData = $salesmen ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sm->id); ?>" <?php if(old('salesman') == $sm->id): echo 'selected'; endif; ?>>
                                    <?php echo e($sm->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
        </div>

        
        <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8 text-gray-900 dark:text-gray-100">
            <h3 class="mb-4 border-b border-gray-200 pb-2 text-lg font-semibold text-gray-800 dark:border-gray-700 dark:text-gray-100">
                Product & Weight Details
            </h3>
            <?php echo $__env->make('admin.purchases.partials.product-section', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        
        <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8 text-gray-900 dark:text-gray-100">
            <h3 class="mb-4 border-b border-gray-200 pb-2 text-lg font-semibold text-gray-800 dark:border-gray-700 dark:text-gray-100">
                Pricing & Charges
            </h3>
            <?php echo $__env->make('admin.purchases.partials.pricing-section', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        
        <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8 text-gray-900 dark:text-gray-100">
            <h3 class="mb-4 border-b border-gray-200 pb-2 text-lg font-semibold text-gray-800 dark:border-gray-700 dark:text-gray-100">
                Diamond Card Details
            </h3>
            <?php echo $__env->make('admin.purchases.partials.card-details', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        
        <div class="flex justify-end">
            <button id="submitBtn" type="submit"
                class="rounded-md bg-purple-600 px-6 py-2 text-white transition duration-150 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                Save Product
            </button>
        </div>
        </form>
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/cards/create.blade.php ENDPATH**/ ?>