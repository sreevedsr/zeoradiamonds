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

    
    <div x-data="{ showModal: false }" @close-purchase-modal.window="showModal = false">
        <div>
            <form method="POST" action="<?php echo e(route('admin.products.store')); ?>" enctype="multipart/form-data"
                x-init="enableSequentialInput($el, '#add-item-btn'); focusFirstInput();" novalidate>
                <?php echo csrf_field(); ?>
                
                <?php echo $__env->make('admin.purchases.partials.header-section', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                
                
                <?php echo $__env->make('admin.purchases.partials.items-table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </form>
        </div>

        <!-- Modern Add Item Modal -->
        <div x-show="showModal" x-transition.opacity.duration.250ms
            class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-md bg-black/50 dark:bg-black/70"
            @click.self="showModal = false" @keydown.escape.window="showModal = false">
            <!-- Modal Panel -->
            <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                class="relative w-[95%] sm:w-11/12 md:w-5/6 lg:w-4/5 xl:max-w-5xl
                       bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700
                       transform transition-all duration-300 max-h-[90vh] flex flex-col overflow-hidden"
                role="dialog" aria-modal="true" aria-labelledby="modal-title" x-data="purchaseForm()">
                <!-- Sticky Header -->
                <div
                    class="flex-none sticky top-0 z-10 flex items-center justify-between px-6 py-4
                            border-b border-gray-200 dark:border-gray-700 bg-gray-50/90 dark:bg-gray-800/80
                            backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-full
                                    bg-purple-100 dark:bg-purple-700/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h2 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            Add New Item
                        </h2>
                    </div>

                    <!-- header close uses parent var -->
                    <button type="button" @click="showModal = false"
                        class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 rounded-full p-2 transition
                               hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Scrollable Body -->
                <div class="flex-1 overflow-y-auto px-6 py-8 custom-scrollbar">
                    <form x-ref="itemForm" class="space-y-12" novalidate>
                        
                        <section>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-4">
                                Product Details
                            </h3>
                            <div class="space-y-6">
                                <?php echo $__env->make('admin.purchases.partials.product-section', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                        </section>

                        <div class="border-t border-gray-200 dark:border-gray-700 my-10"></div>

                        
                        <section>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-4">
                                Pricing & Charges
                            </h3>
                            <div class="space-y-6">
                                <?php echo $__env->make('admin.purchases.partials.pricing-section', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                        </section>

                        <div class="border-t border-gray-200 dark:border-gray-700 my-10"></div>

                        
                        <section>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-4">
                                Certification & Card Details
                            </h3>
                            <div class="space-y-6">
                                <?php echo $__env->make('admin.purchases.partials.card-details', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                        </section>
                    </form>
                </div>

                <!-- Sticky Footer -->
                <div
                    class="flex-none sticky bottom-0 flex flex-col sm:flex-row justify-end gap-3 px-6 py-4
                            border-t border-gray-200 dark:border-gray-700 bg-gray-50/90 dark:bg-gray-800/80 backdrop-blur-sm">
                    <button type="button" @click="showModal = false"
                        class="rounded-md border border-gray-300 dark:border-gray-600 px-5 py-2 text-sm font-medium
                               text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800
                               transition w-full sm:w-auto flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </button>

                    <button type="button" @click="addItem()"
                        class="rounded-md bg-purple-600 hover:bg-purple-700 px-5 py-2 text-sm font-semibold
                               text-white shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-500
                               transition w-full sm:w-auto flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Item
                    </button>
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
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/admin/purchases/create.blade.php ENDPATH**/ ?>