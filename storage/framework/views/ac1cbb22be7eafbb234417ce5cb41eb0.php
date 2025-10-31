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


    <!-- Assign Certificate Section -->
    <div class="p-6 mb-8 bg-white dark:bg-gray-800 rounded-lg shadow max-w-5xl mx-auto">
        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-6">
            Assign a Diamond Certificate
        </h3>

        <!-- Success Message -->
        <?php if(session('success')): ?>
            <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded-md">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('info')): ?>
            <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded-md">
                <?php echo e(session('info')); ?>

            </div>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('admin.cards.assign')); ?>" class="space-y-6" x-data="{ merchantSearch: '', cardSearch: '' }">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 rounded-xl">
                <!-- Merchant Selection -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden transition-all duration-200 hover:shadow-md"
                    x-data="{ merchantSearch: '', selectedMerchant: null }">

                    <div class="p-5 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mr-2"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            Select Merchant
                        </h3>
                    </div>

                    <div class="p-5">
                        <div class="relative mb-4">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" x-model="merchantSearch" placeholder="Search merchant..."
                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600
                dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" />
                        </div>

                        <!-- Merchants List -->
                        <div class="space-y-3 max-h-64 overflow-y-auto custom-scrollbar">
                            <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <template
                                    x-if="'<?php echo e(strtolower($merchant->name . ' ' . $merchant->business_name)); ?>'.includes(merchantSearch.toLowerCase())
">
                                    <div @click="selectedMerchant === <?php echo e($merchant->id); ?> ? selectedMerchant = null : selectedMerchant = <?php echo e($merchant->id); ?>"
                                        :class="selectedMerchant === <?php echo e($merchant->id); ?> ?
                                            'border-purple-500 bg-purple-50 dark:bg-purple-900/30' :
                                            'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800'"
                                        class="border rounded-lg p-4 cursor-pointer transition-all duration-200 hover:shadow-md mb-2">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="font-semibold text-gray-800 dark:text-gray-200">
                                                    <?php echo e($merchant->name); ?>

                                                </h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    <?php echo e($merchant->business_name); ?>

                                                </p>
                                            </div>
                                            <template x-if="selectedMerchant === <?php echo e($merchant->id); ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Reset button (appears when selected) -->
                        <div class="mt-4" x-show="selectedMerchant" x-transition>
                            <button type="button" @click="selectedMerchant = null"
                                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md text-sm hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                Unselect Merchant
                            </button>
                        </div>
                    </div>

                    <!-- Hidden input for selected merchant -->
                    <input type="hidden" name="merchant_id" :value="selectedMerchant">
                </div>


                <!-- Card Selection -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden transition-all duration-200 hover:shadow-md"
                    x-data="{ cardSearch: '', selectedCard: null }">

                    <div class="p-5 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mr-2"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Select Card
                        </h3>
                    </div>

                    <div class="p-5">
                        <!-- Search -->
                        <div class="relative mb-4">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" x-model="cardSearch" placeholder="Search card..."
                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600
                dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" />
                        </div>

                        <!-- Cards List -->
                        <div class="grid grid-cols-2 gap-3 max-h-64 overflow-y-auto custom-scrollbar w-full">
                            <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <template
                                    x-if="'<?php echo e(strtolower($card->card_number . ' ' . $card->clarity . ' ' . $card->color . ' ' . $card->cut . ' ' . $card->certificate_id)); ?>'
        .includes(cardSearch.toLowerCase())">

                                    <div @click="selectedCard === <?php echo e($card->id); ?> ? selectedCard = null : selectedCard = <?php echo e($card->id); ?>"
                                        :class="selectedCard === <?php echo e($card->id); ?> ?
                                            'border-purple-500 ring-2 ring-purple-400 ring-offset-2 bg-purple-50 dark:bg-purple-900/30 dark:ring-offset-gray-900' :
                                            'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800'"
                                        class="border rounded-lg p-4 cursor-pointer transition-all duration-200 hover:shadow-md hover:border-purple-300 relative">

                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-semibold text-gray-800 dark:text-gray-200">
                                                    Card #<?php echo e($card->certificate_id); ?>

                                                </h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                    <?php echo e($card->card_number); ?>

                                                </p>
                                            </div>
                                            <span
                                                class="text-sm font-semibold bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200 px-2 py-1 rounded-full">
                                                <?php echo e($card->carat_weight); ?>ct
                                            </span>
                                        </div>

                                        <div class="flex flex-wrap gap-2 mt-2">
                                            <span
                                                class="text-xs text-gray-700 dark:bg-gray-700 bg-gray-100 dark:text-gray-300 px-2 py-1 rounded">
                                                <?php echo e($card->clarity); ?>

                                            </span>
                                            <span
                                                class="text-xs dark:bg-gray-700 bg-gray-100 text-gray-700 dark:text-gray-300 px-2 py-1 rounded">
                                                <?php echo e($card->color); ?>

                                            </span>
                                            <span
                                                class="text-xs bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 px-2 py-1 rounded">
                                                <?php echo e($card->cut); ?>

                                            </span>
                                            <template x-if="selectedCard === <?php echo e($card->id); ?>">
                                                <div class=" top-3 right-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                            </template>
                                        </div>

                                    </div>
                                </template>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>


                        <!-- Unselect button -->
                        <div class="mt-4" x-show="selectedCard" x-transition>
                            <button type="button" @click="selectedCard = null"
                                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md text-sm hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                Unselect Card
                            </button>
                        </div>
                    </div>

                    <!-- Hidden input for selected card -->
                    <input type="hidden" name="card_id" :value="selectedCard" required>
                </div>

            </div>

            <style>
                .custom-scrollbar::-webkit-scrollbar {
                    width: 6px;
                }

                .custom-scrollbar::-webkit-scrollbar-track {
                    background: #f1f5f9;
                    border-radius: 3px;
                }

                .custom-scrollbar::-webkit-scrollbar-thumb {
                    background: #c7d2fe;
                    border-radius: 3px;
                }

                .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                    background: #a5b4fc;
                }

                .dark .custom-scrollbar::-webkit-scrollbar-track {
                    background: #374151;
                }

                .dark .custom-scrollbar::-webkit-scrollbar-thumb {
                    background: #4b5563;
                }

                .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                    background: #6b7280;
                }
            </style>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700
                   focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-150">
                    Assign Card
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
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Certificate No', 'Merchant', 'Carat', 'Clarity', 'Color', 'Cut', 'Assigned Date']),'from' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->firstItem()),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->lastItem()),'total' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->total()),'pages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(range(1, $cards->lastPage())),'current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cards->currentPage()),'route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.cards.assign')),'searchPlaceholder' => 'Search certificates...']); ?>

        <?php $__empty_1 = true; $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-4 py-3"><?php echo e($card->certificate_id); ?></td>
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