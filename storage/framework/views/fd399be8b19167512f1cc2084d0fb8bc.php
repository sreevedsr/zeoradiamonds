<div
    class="rounded-lg bg-white p-6 dark:bg-gray-800 sm:p-8 text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-transparent shadow-none dark:shadow-md dark:shadow-gray-900/50">
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 ">
        <div> <label class="block text-sm font-medium text-gray-700 dark:text-gray-200"> Invoice No. <span
                    class="text-red-500">*</span> </label> <input type="text" name="invoice_no" x-model="invoice_no"
                value="<?php echo e(old('invoice_no')); ?>"
                class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
        </div>
        <div> <label class="block text-sm font-medium text-gray-700 dark:text-gray-200"> Date <span
                    class="text-red-500">*</span> </label> <input type="date" name="date"
                value="<?php echo e(old('date', now()->toDateString())); ?>" readonly
                class="input-field w-full cursor-not-allowed rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-gray-700 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
        </div>
        <div> <label class="block text-sm font-medium text-gray-700 dark:text-gray-200"> Supplier (Name / Code) <span
                    class="text-red-500">*</span> </label> <select name="supplier" x-model="supplier"
                class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                <option value="">-- Select supplier --</option>
                <?php $__currentLoopData = $suppliers ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($s->id); ?>" <?php if(old('supplier') == $s->id): echo 'selected'; endif; ?>> <?php echo e($s->name); ?> /
                        <?php echo e($s->code ?? $s->id); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select> </div>
        <div> <label class="block text-sm font-medium text-gray-700 dark:text-gray-200"> Salesman <span
                    class="text-red-500">*</span> </label> <select name="salesman" x-model="salesman"
                class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                <option value="">-- Select salesman --</option>
                <?php $__currentLoopData = $salesmen ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($sm->id); ?>" <?php if(old('salesman') == $sm->id): echo 'selected'; endif; ?>> <?php echo e($sm->name); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select> </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/purchases/partials/header-section.blade.php ENDPATH**/ ?>