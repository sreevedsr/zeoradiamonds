<!-- Add Sale Item Modal (DB-driven, event-open) -->
<div x-data="{ open: false }" x-show="open" x-transition.opacity.duration.200ms
    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/40 dark:bg-black/70"
    @open-sale-modal.window="open = true" @close-sale-modal.window="open = false" @click.self="open = false"
    @keydown.escape.window="open = false">

    <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-3"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="relative w-full max-w-5xl bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border overflow-hidden"
        role="dialog">

        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h2 class="text-lg font-semibold">Add Sale Item</h2>
            <button type="button" @click="open = false" class="p-2 rounded-full">
                <!-- X icon -->
            </button>
        </div>

        <form x-ref="saleForm" x-data="saleItemForm()" @submit.prevent="addItem(); open = false"
            class="p-6 space-y-6 overflow-y-auto max-h-[75vh]">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <x-input.text label="SI. No." model="si_no" readonly />
                <x-input.text label="Barcode" model="barcode" placeholder="Scan barcode" />

                <!-- Product Lookup -->
                <div x-data="searchableDropdown({
                    apiUrl: '{{ route('admin.products.lookup') }}',
                    optionLabel: 'product_code',
                    optionValue: 'id'
                })" x-init="init()" class="relative" @click.outside="open = false">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-200">Product</label>

                    <input type="text" x-model="searchQuery" placeholder="Search Product" @focus="open = true"
                        @input="filterOptions()"
                        @keydown.enter.prevent="
                            if (filteredOptions.length > 0) {
                                select(filteredOptions[0]);
                                $dispatch('product-selected', { product: filteredOptions[0] });
                            }
                        "
                        class="input-field w-full rounded-md border border-gray-300 px-3 py-2
                            focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />

                    <div x-show="open" x-transition
                        class="absolute z-10 mt-1 w-full max-h-60 overflow-y-auto rounded-md
                            bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700">
                        <template x-for="option in filteredOptions" :key="option.id">
                            <div @click="select(option); $dispatch('product-selected', { product: option })"
                                class="px-3 py-2 cursor-pointer text-sm hover:bg-purple-100 dark:hover:bg-purple-700/40">
                                <span x-text="option.product_code"></span> —
                                <span class="text-gray-500 text-xs" x-text="option.item_name"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <x-input.text label="Item Code" model="item_code" readonly />
                <x-input.text label="Item Name" model="item_name" readonly />
                <x-input.text label="HSN Code" model="hsn" readonly />

                <x-input.text label="Quantity" model="quantity" readonly />
                <x-input.text label="Gross Weight (g)" model="gross_weight" readonly />
                <x-input.text label="Stone Weight (g)" model="stone_weight" readonly />
                <x-input.text label="Diamond Weight (g)" model="diamond_weight" readonly />
                <x-input.text label="Net Weight (g)" model="net_weight" readonly />
                <x-input.text label="Net Amount (₹)" model="net_amount" readonly />
                <x-input.text label="Total Amount (₹)" model="total_amount_display" readonly />
            </div>

            <!-- Tax summary (uses intraState etc) -->
            <div class="border-t pt-4 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <template x-if="intraState">
                    <div class="grid grid-cols-2 gap-3 col-span-full">
                        <div>
                            <div class="text-xs">CGST (1.5%)</div>
                            <div x-text="formatMoney(cgst_amount)"></div>
                        </div>
                        <div>
                            <div class="text-xs">SGST (1.5%)</div>
                            <div x-text="formatMoney(sgst_amount)"></div>
                        </div>
                    </div>
                </template>

                <template x-if="!intraState">
                    <div>
                        <div class="text-xs">IGST (3%)</div>
                        <div x-text="formatMoney(igst_amount)"></div>
                    </div>
                </template>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <x-secondary-button type="button" @click="open = false">Cancel</x-secondary-button>
                <button type="submit" class="rounded-md bg-purple-600 px-4 py-2 text-white">Add to Sales</button>
            </div>
        </form>
    </div>
</div>
