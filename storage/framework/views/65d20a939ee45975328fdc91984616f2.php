<div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
    <div>
        <label class="text-sm font-medium">Stone Amount</label>
        <input type="number" min="0" step="0.01" name="stone_amount" x-model.number="stone_amount"
            value="<?php echo e(old('stone_amount', 0)); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Diamond Price</label>
        <input type="number" min="0" step="0.01" name="diamond_price" x-model.number="diamond_price"
            value="<?php echo e(old('diamond_price', 0)); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Making Charge</label>
        <input type="number" min="0" step="0.01" name="making_charge" x-model.number="making_charge"
            value="<?php echo e(old('making_charge', 0)); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Card Charge</label>
        <input type="number" min="0" step="0.01" name="card_charge" x-model.number="card_charge"
            value="<?php echo e(old('card_charge', 0)); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Other Charge</label>
        <input type="number" min="0" step="0.01" name="other_charge" x-model.number="other_charge"
            value="<?php echo e(old('other_charge', 0)); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div>
        <label class="text-sm font-medium">Landing Cost (editable)</label>
        <input type="number" min="0" step="0.01" name="landing_cost" x-model.number="landing_cost"
            value="<?php echo e(old('landing_cost', 0)); ?>"
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>

    <div class="col-span-2 grid grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-medium">Retail Cost (%)</label>
            <div class="flex gap-2">
                <input type="number" min="0" step="0.01" x-model.number="retail_percent"
                    name="retail_percent" value="<?php echo e(old('retail_percent', 0)); ?>"
                    class="input-field w-1/2 rounded-md border border-gray-300 px-3 py-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                <input type="text" readonly :value="formatCurrency(retail_cost)"
                    class="input-field w-1/2 rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
            </div>
        </div>

        <div>
            <label class="text-sm font-medium">MRP Cost (%)</label>
            <div class="flex gap-2">
                <input type="number" min="0" step="0.01" x-model.number="mrp_percent" name="mrp_percent"
                    value="<?php echo e(old('mrp_percent', 0)); ?>"
                    class="input-field w-1/2 rounded-md border border-gray-300 px-3 py-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                <input type="text" readonly :value="formatCurrency(mrp_cost)"
                    class="input-field w-1/2 rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
            </div>
        </div>
    </div>

    <div class="col-span-full">
        <label class="text-sm font-medium">Total Amount (Including Gold Rate)</label>
        <input type="text" readonly :value="formatCurrency(total_amount)"
            class="input-field w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-lg font-semibold text-gray-900 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/purchases/partials/pricing-section.blade.php ENDPATH**/ ?>