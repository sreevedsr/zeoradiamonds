<div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
    <div>
        <label class="text-sm font-medium">Product Code</label>
        <input type="text" name="product_code" x-model="item.product_code"
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Item Code</label>
        <input type="text" name="item_code" x-model="item.item_code"
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Item Name <span class="text-red-500">*</span></label>
        <input type="text" name="item_name" x-model="item.item_name" @input="onItemNameChange"
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Quantity <span class="text-red-500">*</span></label>
        <input type="number" min="1" name="quantity" x-model.number="item.quantity"
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Gold Rate (per unit) <span class="text-red-500">*</span></label>
        <input type="number" min="0" step="0.01" name="gold_rate" x-model.number="item.gold_rate"
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Gross Weight (g) <span class="text-red-500">*</span></label>
        <input type="number" min="0" step="0.01" name="gross_weight" x-model.number="item.gross_weight"
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Stone Weight (g)</label>
        <input type="number" min="0" step="0.001" name="stone_weight" x-model.number="item.stone_weight"
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Diamond Weight (g)</label>
        <input type="number" min="0" step="0.001" name="diamond_weight" x-model.number="item.diamond_weight"
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div>
        <label class="text-sm font-medium">Net Weight (g)</label>
        <input type="number" readonly :value="item.net_weight?.toFixed(3) || 0" name="net_weight"
            class="w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2
            text-gray-800 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>
</div>
