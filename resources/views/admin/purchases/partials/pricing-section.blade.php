<div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
    <div>
        <label class="text-sm font-medium">Stone Amount</label>
        <input type="number" min="0" step="0.01" name="stone_amount" x-model.number="item.stone_amount"
            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2
            focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Diamond Price</label>
        <input type="number" min="0" step="0.01" name="diamond_price" x-model.number="item.diamond_price"
            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2
            focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Making Charge</label>
        <input type="number" min="0" step="0.01" name="making_charge" x-model.number="item.making_charge"
            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2
            focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Card Charge</label>
        <input type="number" min="0" step="0.01" name="card_charge" x-model.number="item.card_charge"
            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2
            focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Other Charge</label>
        <input type="number" min="0" step="0.01" name="other_charge" x-model.number="item.other_charge"
            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2
            focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Landing Cost (editable)</label>
        <input type="number" min="0" step="0.01" name="landing_cost" x-model.number="item.landing_cost"
            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2
            focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div class="col-span-2 grid grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-medium">Retail Cost (%)</label>
            <div class="flex gap-2">
                <input type="number" min="0" step="0.01" x-model.number="item.retail_percent"
                    name="retail_percent"
                    class="w-1/2 rounded-md border border-gray-300 px-3 py-2 focus:outline-none
                    focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                <input type="text" readonly :value="formatCurrency(item.retail_cost || 0)"
                    class="w-1/2 rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800
                    dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            </div>
        </div>

        <div>
            <label class="text-sm font-medium">MRP Cost (%)</label>
            <div class="flex gap-2">
                <input type="number" min="0" step="0.01" x-model.number="item.mrp_percent" name="mrp_percent"
                    class="w-1/2 rounded-md border border-gray-300 px-3 py-2 focus:outline-none
                    focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                <input type="text" readonly :value="formatCurrency(item.mrp_cost || 0)"
                    class="w-1/2 rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-gray-800
                    dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            </div>
        </div>
    </div>

    <div class="col-span-full">
        <label class="text-sm font-medium">Total Amount (Including Gold Rate)</label>
        <input type="text" readonly :value="formatCurrency(item.total_amount || 0)"
            class="w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-lg font-semibold
            text-gray-900 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>
</div>
