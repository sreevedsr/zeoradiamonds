<div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4"
    @dropdown-selected.window="item.item_code = $event.detail.selected.item_code;
                                item.item_name = $event.detail.selected.item_name">

    <!-- Product Code -->
    <div>
        <label class="text-sm font-medium">Product Code <span class="text-red-500">*</span></label>
        <input type="text" name="product_code" x-model="item.product_code" placeholder="Enter Product Code" required
            class="w-full rounded-md border border-gray-300 px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-purple-600
                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Item Code Dropdown -->
    <div x-data="searchableDropdown({
        apiUrl: '<?php echo e(route('admin.dropdown.fetch', ['type' => 'products'])); ?>',
        optionLabel: 'item_code',
        optionValue: 'id'
    })" x-init="init()" class="relative" @click.outside="open = false">

        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
            Item Code <span class="text-red-500">*</span>
        </label>

        <input type="text" x-model="searchQuery" placeholder="Search Item Code" @focus="open = true"
            @input="filterOptions()"
            @keydown.enter.prevent="
            if (filteredOptions.length > 0) {
                select(filteredOptions[0]);
                const focusables = Array.from(document.querySelectorAll('input, select, textarea, button'));
                const currentIndex = focusables.indexOf($el);
                if (currentIndex >= 0 && focusables[currentIndex + 1]) {
                    focusables[currentIndex + 1].focus();
                }
            }
        "
            required
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
                    <template x-for="option in filteredOptions" :key="option.id">
                        <li @click="select(option)" tabindex="0" @keydown.enter.prevent="select(option)"
                            class="cursor-pointer px-3 py-2 text-sm
                               hover:bg-purple-100 dark:hover:bg-purple-700/40
                               dark:text-gray-100 border-b border-gray-100 dark:border-gray-700 last:border-0">
                            <div class="flex justify-between items-center">
                                <span x-text="option.item_code"></span>
                                <span class="text-xs text-gray-500 ml-1" x-text="option.item_name"></span>
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

        <input type="hidden" name="item_id" :value="selected ? selected.id : ''">
    </div>

    <!-- Item Name -->
    <div>
        <label class="text-sm font-medium">Item Name <span class="text-red-500">*</span></label>
        <input type="text" name="item_name" x-model="item.item_name" placeholder="Auto-filled" required
            class="w-full rounded-md border border-gray-300 px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-purple-600
                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Quantity -->
    <div>
        <label class="text-sm font-medium">Quantity <span class="text-red-500">*</span></label>
        <input type="number" min="1" name="quantity" x-model.number="item.quantity" placeholder="Enter Quantity"
            required
            class="w-full rounded-md border border-gray-300 px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-purple-600
                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Gold Rate -->
    <div>
        <label class="text-sm font-medium">Gold Rate (per unit) <span class="text-red-500">*</span></label>
        <input type="number" step="0.01" name="gold_rate" x-model="item.gold_rate" x-init="fetchGoldRate()"
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
        <input type="number" step="0.001" name="gross_weight" x-model="item.gross_weight"
            placeholder="Enter Gross Weight" required
            class="w-full rounded-md border border-gray-300 px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-purple-600
                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Stone Weight -->
    <div>
        <label class="text-sm font-medium">Stone Weight (g) <span class="text-red-500">*</span></label>
        <input type="number" step="0.001" name="stone_weight" x-model="item.stone_weight"
            placeholder="Enter Stone Weight" required
            class="w-full rounded-md border border-gray-300 px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-purple-600
                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Diamond Weight -->
    <div>
        <label class="text-sm font-medium">Diamond Weight (ct) <span class="text-red-500">*</span></label>
        <input type="number" step="0.001" name="diamond_weight" x-model="item.diamond_weight"
            placeholder="Enter Diamond Weight" required
            class="w-full rounded-md border border-gray-300 px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-purple-600
                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Net Weight -->
    <div>
        <label class="text-sm font-medium">Net Weight (g) <span class="text-red-500">*</span></label>
        <input type="number" readonly required x-model="item.net_weight" placeholder="Auto-calculated"
            class="w-full rounded-md border border-gray-300 bg-gray-100 px-3 py-2
                   text-gray-700 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 cursor-not-allowed">
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/purchases/partials/product-section.blade.php ENDPATH**/ ?>