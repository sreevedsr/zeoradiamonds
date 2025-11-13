<!-- Add Sale Item Modal -->
<div x-data x-show="$store.saleModal.show" x-transition.opacity.duration.200ms
    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/40 dark:bg-black/70"
    @click.self="$store.saleModal.close()" @keydown.escape.window="$store.saleModal.close()" x-init="$watch('$store.saleModal.show', open => {
        if (open) {
            $nextTick(() => {
                enableSequentialInput($refs.saleForm);
                focusFirstInput($refs.saleForm);
            });
        }
    });">

    <!-- Modal Panel -->
    <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-3"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="relative w-full max-w-5xl bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden"
        role="dialog" aria-modal="true" aria-labelledby="sale-modal-title">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 id="sale-modal-title"
                class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Sale Item
            </h2>
            <button type="button" @click="$store.saleModal.close()"
                class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 rounded-full p-2 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Body -->
        <form x-ref="saleForm" x-data="saleItemForm()" @submit.prevent="addItem"
            class="p-6 space-y-6 overflow-y-auto max-h-[75vh] bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 custom-scrollbar">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <x-input.text label="SI. No." model="si_no" readonly />
                <x-input.text label="Barcode" model="barcode" placeholder="Scan barcode" />

                <!-- 🔍 Searchable Dropdown for Product Code -->
                <div x-data="searchableDropdown({
                    apiUrl: '{{ route('admin.products.lookup') }}',
                    optionLabel: 'product_code',
                    optionValue: 'product_code'
                })" x-init="init()" class="relative" @click.outside="open = false">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-200">Product Code</label>
                    <input type="text" x-model="searchQuery" placeholder="Search Product Code" @focus="open = true"
                        @input="filterOptions()"
                        @keydown.enter.prevent="
                           if (filteredOptions.length > 0) {
                               select(filteredOptions[0]);
                               $dispatch('product-selected', { product: filteredOptions[0] });
                           }"
                        class="input-field w-full rounded-md border border-gray-300 px-3 py-2
                                  focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                    <div x-show="open" x-transition
                        class="absolute z-10 mt-1 w-full max-h-60 overflow-y-auto rounded-md bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700">
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
                <x-input.text label="HSN Code" model="hsn" required readonly />
                <x-input.text label="Quantity" model="quantity" readonly />
                <x-input.text label="Gross Weight (g)" model="gross_weight" readonly />
                <x-input.text label="Stone Weight (g)" model="stone_weight" readonly />
                <x-input.text label="Diamond Weight (g)" model="diamond_weight" readonly />
                <x-input.text label="Net Weight (g)" model="net_weight" readonly />
                <x-input.text label="Net Amount (₹)" model="net_amount" readonly />
                <x-input.text label="Total Amount (₹)" model="total_amount_display" readonly />
            </div>

            <!-- Tax Summary -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <template x-if="intraState">
                    <div class="grid sm:grid-cols-2 gap-3 col-span-full">
                        <div
                            class="p-3 bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700">
                            <div class="text-xs text-gray-500 dark:text-gray-400">CGST (1.5%)</div>
                            <div class="font-medium" x-text="formatMoney(cgst_amount)"></div>
                        </div>
                        <div
                            class="p-3 bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700">
                            <div class="text-xs text-gray-500 dark:text-gray-400">SGST (1.5%)</div>
                            <div class="font-medium" x-text="formatMoney(sgst_amount)"></div>
                        </div>
                    </div>
                </template>
                <template x-if="!intraState">
                    <div
                        class="p-3 bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 col-span-full">
                        <div class="text-xs text-gray-500 dark:text-gray-400">IGST (3%)</div>
                        <div class="font-medium" x-text="formatMoney(igst_amount)"></div>
                    </div>
                </template>
            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <x-secondary-button @click="$store.saleModal.close()">Cancel</x-secondary-button>

                <button type="button" @click="addItem()"
                    class="w-full rounded-md bg-purple-600 px-4 py-2 text-white hover:bg-purple-700">
                    Add to Sales
                </button>
            </div>
        </form>
    </div>
</div>
