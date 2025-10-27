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
    <?php $__env->slot('title', 'Zeeyame - Assign Diamond Certificates'); ?>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Assign Diamond Certificates
    </h2>

    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-5xl mx-auto text-gray-900 dark:text-gray-100 space-y-8">

            <!-- Success / Error Messages -->
            <?php if(session('success')): ?>
                <div class="p-3 bg-green-200 text-green-800 rounded">
                    <?php echo e(session('success')); ?>

                </div>
            <?php elseif(session('error')): ?>
                <div class="p-3 bg-red-200 text-red-800 rounded">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <!-- Assignment Form -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Assign Certificate to Customer</h3>
                <form action="<?php echo e(route('merchant.assignCard')); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Select Customer -->
                        
                        
                        
                        <div class="mb-6">
                            <label for="customer"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Select Customer
                            </label>
                            <select id="customer" name="customer" required
                                class="block w-full px-3 py-2 text-sm bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200
               border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
               focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
               transition ease-in-out duration-200">
                                <option value="" disabled selected>-- Select Customer --</option>
                                <option value="1">John Doe</option>
                                <option value="2">Jane Smith</option>
                            </select>
                        </div>



                        <!-- Select Card -->
                        <div class="mb-6">
                            <label for="card_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Select Certificate
                            </label>
                            <select name="card_id" id="card_id" required
                                class="block w-full px-3 py-2 text-sm bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200
               border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
               focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition ease-in-out duration-200">
                                
                                
                                
                                    
                                
                                <option value="" disabled selected>-- Select Certificate --</option>
                                <option value="1">Certificate 1 </option>
                                <option value="2">Certificate 2</option>
                                
                            </select>
                        </div>

                    </div>

                    <!-- Assign Button -->
                    <div>
                        <button type="submit"
                            class="px-4 my-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400">
                            Assign Certificate
                        </button>
                    </div>
                </form>
            </div>
            <div class="p-6"></div>
            <!-- Assigned Certificates Table -->
            <div>
                <h3 class="text-lg font-semibold my-4">Assigned Certificates</h3>
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Customer</th>
                                <th class="px-4 py-3">Certificate ID</th>
                                <th class="px-4 py-3">Diamond Type</th>
                                <th class="px-4 py-3">Carat Weight</th>
                                <th class="px-4 py-3">Assigned On</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            
                            <tr class="text-gray-700 dark:text-gray-400">
                                
                                </td>
                            </tr>
                            
                            
                        </tbody>
                    </table>
                </div>
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/merchant/cards/assign.blade.php ENDPATH**/ ?>