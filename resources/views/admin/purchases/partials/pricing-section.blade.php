<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    <!-- Stone Amount -->
    <x-input.text type="number" label="Stone Amount" name="stone_amount" model="item.stone_amount" min="0"
        step="0.01" />

    <!-- Diamond Rate -->
    <div class="space-y-1">
        <x-input.text type="number" label="Diamond Rate (per carat)" name="diamond_rate" model="item.diamond_rate"
            min="0" step="0.01" x-init="fetchDiamondRate()" required />
        <p class="text-xs text-gray-500 dark:text-gray-400">
            Auto-fetched from latest diamond rate.
        </p>
    </div>

    <!-- Making Charge -->
    <x-input.text type="number" label="Making Charge" name="making_charge" model="item.making_charge" min="0"
        step="0.01" />

    <!-- Card Charge -->
    <x-input.text type="number" label="Card Charge" name="card_charge" model="item.card_charge" min="0"
        step="0.01" />

    <!-- Other Charge -->
    <x-input.text type="number" label="Other Charge" name="other_charge" model="item.other_charge" min="0"
        step="0.01" />

    <!-- Total Amount -->
    <div class="col-span-full lg:col-span-2">
        <x-input.text type="text" label="Total Amount (Including Gold Rate)" name="total_amount" readonly
            x-bind:value="formatCurrency(item.total_amount || 0)"
            class="font-semibold text-lg sm:text-xl bg-gray-50 dark:bg-gray-800" />
    </div>

    <!-- Landing Cost -->
    <div class="lg:col-span-2">
        <x-input.text type="number" label="Landing Cost" name="landing_cost" model="item.landing_cost"
            min="0" step="0.01" class="font-semibold text-base sm:text-lg" />
    </div>

    <!-- Retail & MRP Costs -->
    <div class="col-span-full grid grid-cols-1 sm:grid-cols-2 gap-4">

        <!-- Retail Markup -->
        <div class="space-y-1.5">
            <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-200">
                    Retail Cost (%)
                </label>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <!-- Retail % Input -->
                <x-input.text type="number" name="retail_percent" model="item.retail_percent" min="0"
                    step="0.01" placeholder="Enter percentage" class="flex-1 text-sm" />

                <!-- Retail Cost Result -->
                <x-input.text type="text" name="retail_cost" readonly
                    x-bind:value="formatCurrency(item.retail_cost || 0)"
                    class="flex-1 bg-gray-50 dark:bg-gray-800 font-medium text-gray-800 dark:text-gray-100" />
            </div>
        </div>

        <!-- MRP Margin -->
        <div class="space-y-1.5">
            <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-200">
                    MRP Cost (%)
                </label>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <!-- MRP % Input -->
                <x-input.text type="number" name="mrp_percent" model="item.mrp_percent" min="0" step="0.01"
                    placeholder="Enter percentage" class="flex-1 text-sm" />

                <!-- MRP Cost Result -->
                <x-input.text type="text" name="mrp_cost" readonly x-bind:value="formatCurrency(item.mrp_cost || 0)"
                    class="flex-1 bg-gray-50 dark:bg-gray-800 font-medium text-gray-800 dark:text-gray-100" />
            </div>
        </div>

    </div>



</div>
