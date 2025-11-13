<div
    class="rounded-lg bg-white dark:bg-gray-800 p-8 border border-gray-200 dark:border-transparent
    text-gray-900 dark:text-gray-100 shadow-none dark:shadow-md dark:shadow-gray-900/50">

    <!-- Section Header -->
    <div class="flex items-center justify-between mb-4 border-b border-gray-200 dark:border-gray-700 pb-3">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Items Added</h3>

        <button type="button" id="add-item-btn" tabindex="5" @click="showModal = true"
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
    <div x-data="tempItemsTable()" x-init="loadItems()" @refresh-temp-items.window="loadItems()">
        <table class="min-w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium">#</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Item Code</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Item Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Qty</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Net Wt</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Amount</th>
                    <th class="px-4 py-2 text-right text-sm font-medium">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 dark:divide-gray-700" x-show="items.length">
                <template x-for="(item, index) in items" :key="item.id">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        <td class="px-4 py-2 text-sm" x-text="index + 1"></td>
                        <td class="px-4 py-2 text-sm" x-text="item.item_code"></td>
                        <td class="px-4 py-2 text-sm" x-text="item.item_name"></td>
                        <td class="px-4 py-2 text-sm" x-text="item.quantity || '-'"></td>
                        <td class="px-4 py-2 text-sm" x-text="item.net_weight"></td>
                        <td class="px-4 py-2 text-sm" x-text="item.total_amount"></td>
                        <td class="px-4 py-2 text-right">
                            <button type="button" @click="deleteItem(item.id)"
                                class="text-red-500 hover:text-red-700 text-sm font-medium">
                                Remove
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>

            <tbody x-show="!items.length">
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 text-sm">
                        No items added yet. Click “Add Item” to begin.
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Totals -->
        <div class="flex justify-between items-center mt-6">
            <div class="text-gray-700 dark:text-gray-200 text-sm">
                <span>Total Items:</span>
                <span x-text="items.length"></span>
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
<?php $component->withAttributes(['type' => 'submit']); ?>
                Submit Purchase
             <?php echo $__env->renderComponent(); ?>
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
    </div>
</div>
<script>
    function tempItemsTable() {
        return {
            items: [],

            async loadItems() {
                const res = await fetch('/admin/temp-items');
                const data = await res.json();

                // Force Alpine to re-render table
                this.items = [];
                await this.$nextTick();
                this.items = data;
            },

            async deleteItem(id) {
                await fetch(`/admin/temp-items/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                // Refresh table instantly
                this.loadItems();
            }
        };
    }
</script>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/purchases/partials/items-table.blade.php ENDPATH**/ ?>