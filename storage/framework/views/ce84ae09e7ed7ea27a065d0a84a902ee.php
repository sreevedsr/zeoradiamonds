<div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
    <template
        x-for="field in ['product_code','item_code','item_name','quantity','gold_rate','gross_weight','stone_weight','diamond_weight']"
        hidden></template>

    <div>
        <label class="text-sm font-medium">Product Code</label>
        <input type="text" name="product_code" x-model="product_code" value="<?php echo e(old('product_code')); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Item Code</label>
        <input type="text" name="item_code" x-model="item_code" value="<?php echo e(old('item_code')); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Item Name <span class="text-red-500">*</span></label>
        <input type="text" name="item_name" x-model="item_name" value="<?php echo e(old('item_name')); ?>"
            @input="onItemNameChange"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Quantity <span class="text-red-500">*</span></label>
        <input type="number" min="1" name="quantity" x-model.number="quantity" value="<?php echo e(old('quantity', 1)); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Gold Rate (per unit) <span class="text-red-500">*</span></label>
        <input type="number" min="0" step="0.01" name="gold_rate" x-model.number="gold_rate"
            value="<?php echo e(old('gold_rate', 0)); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Gross Weight (g) <span class="text-red-500">*</span></label>
        <input type="number" min="0" step="0.01" name="gross_weight" x-model.number="gross_weight"
            value="<?php echo e(old('gross_weight', 0)); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Stone Weight (g)</label>
        <input type="number" min="0" step="0.001" name="stone_weight" x-model.number="stone_weight"
            value="<?php echo e(old('stone_weight', 0)); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Diamond Weight (g)</label>
        <input type="number" min="0" step="0.001" name="diamond_weight" x-model.number="diamond_weight"
            value="<?php echo e(old('diamond_weight', 0)); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Net Weight (g)</label>
        <input type="number" readonly :value="net_weight.toFixed(3)" name="net_weight"
            class="input-field w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/purchases/partials/product-section.blade.php ENDPATH**/ ?>