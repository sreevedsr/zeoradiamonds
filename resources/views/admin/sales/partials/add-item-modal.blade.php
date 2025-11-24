<!-- Add Sale Item Inline -->
<div class="rounded-lg bg-gray-50 dark:bg-gray-800 p-6 mb-6"
     x-data="inlineSaleItem()">

    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
        Add Item to Sale
    </h3>

    <!-- Product Dropdown USING searchableProductDropdown -->
    <div x-data="searchableProductDropdown({
            apiUrl: '{{ route('admin.dropdown.fetch', ['type' => 'sale_products']) }}'
        })"
        @dropdown-selected.window="handleProduct($event.detail.selected)"
        @click.outside="open = false"
        class="relative md:w-1/2">

        <label class="text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
            Select Product
        </label>

        <input type="text"
               x-model="searchQuery"
               @focus="open = true"
               @input="filterOptions()"
               placeholder="Search product..."
               class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                      px-3 py-2 text-sm bg-white dark:bg-gray-700
                      focus:ring-2 focus:ring-purple-600 dark:text-gray-100" />

        <!-- Dropdown -->
        <div x-show="open" x-transition
             class="absolute z-20 mt-1 w-full max-h-60 overflow-y-auto rounded-lg
                    bg-white dark:bg-gray-800 shadow-xl border border-gray-200 dark:border-gray-700">

            <template x-if="filteredOptions.length > 0">
                <template x-for="option in filteredOptions" :key="option.product_code">
                    <div @click="select(option)"
                         class="px-3 py-2 cursor-pointer text-sm
                                hover:bg-purple-50 dark:hover:bg-purple-700/30">
                        <span x-text="option.product_code"></span> —
                        <span class="text-xs text-gray-500" x-text="option.item_name"></span>
                    </div>
                </template>
            </template>

            <template x-if="filteredOptions.length === 0">
                <div class="px-3 py-2 text-sm text-gray-500">
                    No results found
                </div>
            </template>
        </div>
    </div>

    <!-- PRODUCT DETAILS CARD -->
    <template x-if="selected">

        <div class="mt-6 p-5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900">

            <h4 class="text-md font-semibold mb-3 text-gray-900 dark:text-gray-200">
                Product Details
            </h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                <x-input.text label="SI. No." model="item.si_no" readonly />
                <x-input.text label="Barcode" model="item.barcode" readonly />
                <x-input.text label="Item Code" model="item.item_code" readonly />
                <x-input.text label="Item Name" model="item.item_name" readonly />
                <x-input.text label="HSN Code" model="item.hsn" readonly />
                <x-input.text label="Quantity" model="item.quantity" readonly />
                <x-input.text label="Net Weight (g)" model="item.net_weight" readonly />
                <x-input.text label="Net Amount (₹)" model="item.net_amount" readonly />

                <!-- Editable -->
                <div>
                    <label class="text-sm font-medium">Total Amount (₹)</label>
                    <input type="number" x-model="item.total_amount"
                           class="w-full rounded-md border border-gray-300 dark:border-gray-700 px-3 py-2
                                  focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:text-gray-100">
                </div>
            </div>

            <div class="mt-5 text-right">
                <button type="button"
                        @click="addToParent()"
                        class="rounded-md bg-purple-600 px-5 py-2.5 text-white text-sm
                               hover:bg-purple-700 shadow">
                    Add to Sales Table
                </button>
            </div>

        </div>

    </template>

</div>
