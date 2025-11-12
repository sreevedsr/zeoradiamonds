<div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4"
    @dropdown-selected.window="item.item_code = $event.detail.selected.item_code;
                                item.item_name = $event.detail.selected.item_name">

    <!-- Product Code -->
    <x-input.text label="Product Code" name="product_code" model="item.product_code" placeholder="Enter Product Code"
        required />
    <!-- Item Code Dropdown -->
    <div x-data="searchableDropdown({
        apiUrl: '{{ route('admin.dropdown.fetch', ['type' => 'products']) }}',
        optionLabel: 'item_code',
        optionValue: 'id'
    })" x-init="init()" class="relative mt-1" {{-- ✅ keeps spacing consistent --}}
        @click.outside="open = false">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
            Item Code <span class="text-red-500">*</span>
        </label>

        <!-- Search Input -->
        <input type="text" x-model="searchQuery" placeholder="Search Item Code" required @focus="open = true"
            @input="filterOptions()"
            @keydown.enter.prevent="
            if (filteredOptions.length > 0) {
                select(filteredOptions[0]);
                const focusables = Array.from(document.querySelectorAll('.input-field, button'));
                const currentIndex = focusables.indexOf($el);
                if (currentIndex >= 0 && focusables[currentIndex + 1]) {
                    focusables[currentIndex + 1].focus();
                }
            }"
            required
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2
               focus:outline-none focus:ring-2 focus:ring-purple-600
               dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100
               hover:border-purple-400 transition duration-150" />

        <!-- Dropdown container (absolutely positioned, no extra height) -->
        <div x-show="open" x-transition
            class="absolute z-10 mt-1 w-full max-h-60 overflow-y-auto rounded-md
               bg-white dark:bg-gray-800 shadow-lg custom-scrollbar border-0"
            style="top: calc(100% + 0.25rem);" {{-- ✅ forces it below the input --}}>
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
    <x-input.text label="Item Name" name="item_name" model="item.item_name" placeholder="Auto-filled" required />

    <!-- Quantity -->
    <x-input.text type="number" label="Quantity" name="quantity" model="item.quantity" placeholder="Enter Quantity"
        min="1" required />

    <!-- Gold Rate -->
    <div>
        <x-input.text type="number" label="Gold Rate (per unit)" name="gold_rate" model="item.gold_rate" step="0.01"
            placeholder="Auto-filled from rate" x-init="fetchGoldRate()" required />
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
            Auto-fetched from latest gold rate.
        </p>
    </div>

    <!-- Gross Weight -->
    <x-input.text type="number" label="Gross Weight (g)" name="gross_weight" model="item.gross_weight" step="0.001"
        placeholder="Enter Gross Weight" required />

    <!-- Stone Weight -->
    <x-input.text type="number" label="Stone Weight (g)" name="stone_weight" model="item.stone_weight" step="0.001"
        placeholder="Enter Stone Weight" required />

    <!-- Diamond Weight -->
    <x-input.text type="number" label="Diamond Weight (ct)" name="diamond_weight" model="item.diamond_weight"
        step="0.001" placeholder="Enter Diamond Weight" required />

    <!-- Net Weight -->
    <x-input.text type="number" label="Net Weight (g)" name="net_weight" model="item.net_weight" readonly
        placeholder="Auto-calculated" />
</div>
