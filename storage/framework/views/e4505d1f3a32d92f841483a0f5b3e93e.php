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
    <?php $__env->slot('title', 'Upload Sales Details (B2B)'); ?>

    <form method="POST" action="<?php echo e(route('admin.products.assign')); ?>" enctype="multipart/form-data" x-data="purchaseForm()"
        x-init="enableSequentialInput(document, '#add-sale-item-btn');
        focusFirstInput();">
        <?php echo csrf_field(); ?>

        <div class="space-y-8">

            
            <div
                class="rounded-lg bg-white dark:bg-gray-800 p-8 border border-gray-200 dark:border-transparent
                text-gray-900 dark:text-gray-100 shadow-none dark:shadow-md dark:shadow-gray-900/50">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    <!-- Entry No (Auto) -->
                    <div>
                        <label class="text-sm font-medium">Entry No.</label>
                        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'entry_no','value' => ''.e($nextEntryNo ?? 'AUTO').'','readonly' => true,'class' => 'w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300']); ?>
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

                    <!-- Date (Auto) -->
                    <div>
                        <label class="text-sm font-medium">Date</label>
                        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'date','value' => ''.e(now()->format('d-m-Y')).'','readonly' => true,'class' => 'w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300']); ?>
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

                    <!-- Invoice No -->
                    <div>
                        <label class="text-sm font-medium">Invoice No.</label>
                        <?php if (isset($component)) { $__componentOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8d1187b2ef4f66f642fdbe432c184c8 = $attributes; } ?>
<?php $component = App\View\Components\Input\Text::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input\Text::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'invoice_no','placeholder' => 'Enter Invoice No','class' => 'input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-purple-500']); ?>
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

                    <div x-data="searchableDropdown({
                        apiUrl: '<?php echo e(route('dropdown.fetch', ['type' => 'merchants'])); ?>',
                        optionLabel: 'name',
                        optionValue: 'id'
                    })" x-init="init()"
                        @dropdown-selected.window="
        // Optional: update nearby read-only merchant info fields
        document.querySelector('input[name=merchant_state]').value = $event.detail.selected.state || '';
    "
                        class="relative" @click.outside="open = false">


                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Merchant (Name / Code)
                        </label>

                        <!-- Focusable input (for sequential input) -->
                        <input type="text" x-model="searchQuery" @input="filterOptions()" @focus="open = true"
                            @keydown.enter.prevent="
            if (filteredOptions.length > 0) {
                select(filteredOptions[0]);
                // move to next focusable input
                const focusables = Array.from(document.querySelectorAll('input, select, textarea, button'));
                const currentIndex = focusables.indexOf($el);
                if (currentIndex >= 0 && focusables[currentIndex + 1]) {
                    focusables[currentIndex + 1].focus();
                }
            }
        "
                            tabindex="3" placeholder="Search merchant"
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2
               focus:outline-none focus:ring-2 focus:ring-purple-600
               dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100
               hover:border-purple-400 transition duration-150" />

                        <!-- Dropdown container -->
                        <div x-show="open" x-transition
                            class="absolute z-10 mt-1 w-full max-h-60 overflow-y-auto rounded-md
               bg-white dark:bg-gray-800 shadow-lg custom-scrollbar border-0">

                            <template x-if="filteredOptions.length > 0">
                                <ul>
                                    <template x-for="option in filteredOptions" :key="option[optionValue]">
                                        <li @click="select(option)" tabindex="0"
                                            @keydown.enter.prevent="select(option)"
                                            class="cursor-pointer px-3 py-2 text-sm
                               hover:bg-purple-100 dark:hover:bg-purple-700/40
                               dark:text-gray-100 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <span x-text="option.name"></span>
                                                    <span class="text-xs text-gray-500 ml-1"
                                                        x-text="'(' + option.merchant_code + ')'"></span>
                                                </div>
                                                <div class="text-xs text-gray-400" x-text="option.state"></div>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </template>

                            <template x-if="filteredOptions.length === 0">
                                <div class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                                    No results found
                                </div>
                            </template>
                        </div>

                        <!-- Hidden inputs for backend form -->
                        <input type="hidden" name="merchant_id" :value="selected ? selected.id : ''">
                        <input type="hidden" name="merchant_state" :value="selected ? selected.state : ''">
                    </div>
                </div>
            </div>

            
            <div
                class="rounded-lg bg-white dark:bg-gray-800 p-8 border border-gray-200 dark:border-transparent
                text-gray-900 dark:text-gray-100 shadow-none dark:shadow-md dark:shadow-gray-900/50">

                <!-- Section Header -->
                <div class="flex items-center justify-between mb-4 border-b border-gray-200 dark:border-gray-700 pb-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Items Sold</h3>

                    <button type="button" id="add-sale-item-btn" tabindex="5" @click="$store.purchaseModal.open()"
                        class="flex items-center gap-2 rounded-md bg-purple-600 px-4 py-2 text-white text-sm
                        hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Item
                    </button>
                </div>

                <!-- Items Table -->
                <div class="overflow-x-auto rounded-lg border border-gray-100 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">#
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Barcode</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Item Name</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300">Qty</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300">Net Wt</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300">Net Amount
                                </th>
                                <th class="px-4 py-2 text-right text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Total</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700"
                            x-show="$store.purchaseModal.items.length">
                            <template x-for="(item, index) in $store.purchaseModal.items" :key="index">
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-2 text-sm" x-text="index + 1"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.barcode"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.item_name"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.quantity"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.net_weight"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.net_amount"></td>
                                    <td class="px-4 py-2 text-right" x-text="item.total_amount"></td>
                                </tr>
                            </template>
                        </tbody>

                        <tbody x-show="!$store.purchaseModal.items.length">
                            <tr>
                                <td colspan="7"
                                    class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 text-sm">
                                    No items added yet. Click “Add Item” to begin.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="flex justify-between items-center mt-6">
                    <div class="text-gray-700 dark:text-gray-200 text-sm">
                        <span>Total Items:</span>
                        <span x-text="$store.purchaseModal.items.length"></span>
                    </div>

                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit']); ?>Submit Sales <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                </div>

                <input type="hidden" name="items_json" :value="JSON.stringify($store.purchaseModal.items)">
            </div>
        </div>
    </form>

    
    <?php echo $__env->make('admin.sales.partials.add-item-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/sales/create.blade.php ENDPATH**/ ?>