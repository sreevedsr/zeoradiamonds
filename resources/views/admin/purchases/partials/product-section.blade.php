<div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
    <!-- Product Code -->
    <div>
        <label class="text-sm font-medium">Product Code</label>
        <input type="text" name="product_code" x-model="item.product_code"
            placeholder="Enter Product Code" required
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Item Code Dropdown -->
    <div x-data="searchableDropdown({
        apiUrl: '{{ route('dropdown.fetch', ['type' => 'products']) }}',
        optionLabel: 'item_code',
        optionValue: 'id'
    })"
        x-init="$watch('$store.purchaseModal.show', show => { if (show) init() })"
        @click.away="open = false"
        class="relative w-full">

        <label class="text-sm font-medium">Item Code</label>

        <input type="text" x-model="searchQuery" placeholder="Search Item Code"
            @focus="open = true" @input="filterOptions" required
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">

        <!-- Dropdown -->
        <div x-show="open" x-transition
            class="absolute left-0 right-0 z-[9999] mt-1 max-h-48 w-full overflow-y-auto
            rounded-md border bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800">

            <template x-for="option in filteredOptions" :key="option.id">
                <div @click="select(option); item.item_code = option.item_code; item.item_name = option.item_name;"
                    class="cursor-pointer px-3 py-2 hover:bg-purple-100 dark:hover:bg-purple-700 dark:text-gray-100">
                    <span x-text="option.item_code"></span> —
                    <span class="text-sm text-gray-500" x-text="option.item_name"></span>
                </div>
            </template>

            <div x-show="!filteredOptions.length"
                class="px-3 py-2 text-sm text-gray-400 dark:text-gray-300">
                No products found
            </div>
        </div>
    </div>

    <!-- Item Name -->
    <div>
        <label class="text-sm font-medium">Item Name <span class="text-red-500">*</span></label>
        <input type="text" name="item_name" x-model="item.item_name"
            placeholder="Auto-filled" required
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Quantity -->
    <div>
        <label class="text-sm font-medium">Quantity <span class="text-red-500">*</span></label>
        <input type="number" min="1" name="quantity" x-model.number="item.quantity"
            placeholder="Enter Quantity" required
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Gold Rate -->
    <div x-data="{
        item: { gold_rate: '' },
        async fetchGoldRate() {
            try {
                const response = await fetch('/admin/api/latest-gold-rate');
                const data = await response.json();
                this.item.gold_rate = data.rate ?? '';
            } catch (error) {
                console.error('Failed to fetch gold rate:', error);
            }
        }
    }" x-init="fetchGoldRate()">
        <label class="text-sm font-medium">Gold Rate (per unit) <span class="text-red-500">*</span></label>
        <input type="number" step="0.01" name="gold_rate" x-model="item.gold_rate"
            placeholder="Auto-filled from rate" required
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
            Auto-fetched from latest gold rate.
        </p>
    </div>

    <!-- Gross Weight -->
    <div>
        <label class="text-sm font-medium">Gross Weight (g) <span class="text-red-500">*</span></label>
        <input type="number" step="0.01" name="gross_weight" x-model="item.gross_weight"
            placeholder="Enter Gross Weight" required
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Stone Weight -->
    <div>
        <label class="text-sm font-medium">Stone Weight (g)</label>
        <input type="number" step="0.001" name="stone_weight" x-model="item.stone_weight"
            placeholder="Enter Stone Weight"
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Diamond Weight -->
    <div>
        <label class="text-sm font-medium">Diamond Weight (g)</label>
        <input type="number" step="0.001" name="diamond_weight" x-model="item.diamond_weight"
            placeholder="Enter Diamond Weight"
            class="w-full rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600
            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Net Weight -->
    <div>
        <label class="text-sm font-medium">Net Weight (g)</label>
        <input type="number" readonly
            :value="(item.gross_weight - (item.stone_weight || 0) - (item.diamond_weight || 0)) || ''"
            name="net_weight" placeholder="Auto-calculated"
            class="w-full rounded-md border border-gray-300 bg-gray-100 px-3 py-2
            text-gray-700 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 cursor-not-allowed">
    </div>
</div>
