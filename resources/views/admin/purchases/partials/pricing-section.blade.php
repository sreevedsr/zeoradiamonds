<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    <!-- Stone Amount -->
    <div>
        <x-input.text type="number" label="Stone Amount" name="stone_amount" model="item.stone_amount" min="0"
            step="0.01" x-bind:class="errors.stone_amount ? 'border-red-500' : ''" />
        <p class="text-red-500 text-xs mt-1" x-text="errors.stone_amount" x-show="errors.stone_amount"></p>
    </div>

    <!-- Diamond Rate -->
    <div class="space-y-1">
        <x-input.text type="number" label="Diamond Rate (per carat)" name="diamond_rate" x-model="diamond_rate"
            min="0" step="0.01" required x-bind:class="errors.diamond_rate ? 'border-red-500' : ''" />
        <p class="text-red-500 text-xs mt-1" x-text="errors.diamond_rate" x-show="errors.diamond_rate"></p>

        <p class="text-xs text-gray-500 dark:text-gray-400">
            Auto-fetched from latest diamond rate.
        </p>
    </div>

    <!-- Making Charge -->
    <div>
        <x-input.text type="number" label="Making Charge" name="making_charge" model="item.making_charge"
            min="0" step="0.01" x-bind:class="errors.making_charge ? 'border-red-500' : ''" />
        <p class="text-red-500 text-xs mt-1" x-text="errors.making_charge" x-show="errors.making_charge"></p>
    </div>

    <!-- Card Charge -->
    <div>
        <x-input.text type="number" label="Card Charge" name="card_charge" model="item.card_charge" min="0"
            step="0.01" x-bind:class="errors.card_charge ? 'border-red-500' : ''" />
        <p class="text-red-500 text-xs mt-1" x-text="errors.card_charge" x-show="errors.card_charge"></p>
    </div>

    <!-- Other Charge -->
    <div>
        <x-input.text type="number" label="Other Charge" name="other_charge" model="item.other_charge" min="0"
            step="0.01" x-bind:class="errors.other_charge ? 'border-red-500' : ''" />
        <p class="text-red-500 text-xs mt-1" x-text="errors.other_charge" x-show="errors.other_charge"></p>
    </div>

    <!-- Total Amount -->
    <div class="col-span-full lg:col-span-2">
        <x-input.text type="text" label="Total Amount (Including Gold Rate)" name="total_amount" readonly
            x-bind:value="formatCurrency(item.total_amount || 0)"
            class="font-semibold text-lg sm:text-xl bg-gray-50 dark:bg-gray-800
                   border border-gray-300 dark:border-gray-700"
            x-bind:class="errors.total_amount ? 'border-red-500' : ''" />
        <p class="text-red-500 text-xs mt-1" x-text="errors.total_amount" x-show="errors.total_amount"></p>
    </div>

    <!-- Landing Cost -->
    <div class="lg:col-span-2">
        <x-input.text type="number" label="Landing Cost" name="landing_cost" model="item.landing_cost" min="0"
            step="0.01" class="font-semibold text-base sm:text-lg"
            x-bind:class="errors.landing_cost ? 'border-red-500' : ''" />
        <p class="text-red-500 text-xs mt-1" x-text="errors.landing_cost" x-show="errors.landing_cost"></p>
    </div>

    <!-- Retail & MRP Costs -->
    <div class="col-span-full grid grid-cols-1 sm:grid-cols-2 gap-4">

        <!-- Retail -->
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-200">
                Retail Cost (%)
            </label>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2">

                <!-- Retail % -->
                <x-input.text type="number" name="retail_percent" model="item.retail_percent" min="0"
                    step="0.01" placeholder="Enter percentage" class="flex-1 text-sm"
                    x-bind:class="errors.retail_percent ? 'border-red-500' : ''" />
                <p class="text-red-500 text-xs mt-1" x-text="errors.retail_percent" x-show="errors.retail_percent"></p>

                <!-- Retail Value -->
                <x-input.text type="text" name="retail_cost" readonly
                    x-bind:value="formatCurrency(item.retail_cost || 0)"
                    class="flex-1 bg-gray-50 dark:bg-gray-800
                           font-medium text-gray-800 dark:text-gray-100" />
            </div>
        </div>

        <!-- MRP -->
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-200">
                MRP Cost (%)
            </label>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2">

                <!-- MRP % -->
                <x-input.text type="number" name="mrp_percent" model="item.mrp_percent" min="0" step="0.01"
                    placeholder="Enter percentage" class="flex-1 text-sm"
                    x-bind:class="errors.mrp_percent ? 'border-red-500' : ''" />
                <p class="text-red-500 text-xs mt-1" x-text="errors.mrp_percent" x-show="errors.mrp_percent"></p>

                <!-- MRP Value -->
                <x-input.text type="text" name="mrp_cost" readonly x-bind:value="formatCurrency(item.mrp_cost || 0)"
                    class="flex-1 bg-gray-50 dark:bg-gray-800
                           font-medium text-gray-800 dark:text-gray-100" />
            </div>
        </div>
    </div>
</div>
