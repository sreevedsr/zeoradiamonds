<!-- Add Sale Item Modal -->
<div x-data="{ open: false }" x-show="open" x-transition.opacity.duration.200ms
    class="fixed inset-0 z-50 flex items-center justify-center
           bg-black/50 backdrop-blur-md p-4 sm:p-6"
    @open-sale-modal.window="open = true" @close-sale-modal.window="open = false" @click.self="open = false"
    @keydown.escape.window="open = false">

    <!-- MODERN MODAL BOX -->
    <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-3"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="relative w-full max-w-4xl lg:max-w-5xl
                bg-white/90 dark:bg-gray-900/90
                backdrop-blur-xl
                border border-gray-200/40 dark:border-gray-700/40
                rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.12)]
                overflow-hidden">

        <!-- Header -->
        <div
            class="flex items-center justify-between px-6 py-4 border-b
                    bg-gray-50/50 dark:bg-gray-800/40">
            <h2 class="text-lg font-semibold tracking-wide">
                Add Sale Item
            </h2>

            <button type="button" @click="open = false"
                class="p-2 rounded-full hover:bg-gray-200/60
                       dark:hover:bg-gray-700/60 transition">
                ✕
            </button>
        </div>

        <!-- FORM -->
        <form x-ref="saleItemForm" x-data="addSaleItemModal()" @submit.prevent="addItem(); open = false"
            class="p-6 space-y-6 overflow-y-auto max-h-[70vh] sm:max-h-[75vh]">

            <!-- GRID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <x-input.text label="SI. No." model="item.si_no" readonly />
                <x-input.text label="Barcode" model="item.barcode" readonly />

                <!-- Product Search Dropdown -->
                <div x-data="searchableProductDropdown({
                    apiUrl: '{{ route('admin.dropdown.fetch', ['type' => 'sale_products']) }}'
                })" @dropdown-selected.window="handleProductSelect"
                    @click.outside="open = false" class="relative">

                    <label class="text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                        Product
                    </label>

                    <input type="text" x-model="searchQuery" placeholder="Search Product" @focus="open = true"
                        @input="filterOptions()"
                        @keydown.enter.prevent="filteredOptions.length ? select(filteredOptions[0]) : null"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                               bg-white/70 dark:bg-gray-700/60
                               px-3 py-2 text-sm shadow-sm
                               focus:ring-2 focus:ring-purple-500 focus:outline-none
                               dark:text-gray-100" />

                    <!-- Dropdown -->
                    <div x-show="open" x-transition
                        class="absolute z-10 mt-1 w-full max-h-60 overflow-y-auto rounded-lg
                               bg-white dark:bg-gray-800 shadow-xl
                               border border-gray-200 dark:border-gray-700">

                        <template x-if="filteredOptions.length > 0">
                            <template x-for="option in filteredOptions" :key="option.id">
                                <div @click="select(option)"
                                    class="px-3 py-2 cursor-pointer text-sm
                                           hover:bg-purple-100/70 dark:hover:bg-purple-700/40">
                                    <span x-text="option.product_code"></span> —
                                    <span class="text-gray-500 text-xs" x-text="option.item_name"></span>
                                </div>
                            </template>
                        </template>

                        <template x-if="filteredOptions.length === 0">
                            <div class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                                No results found
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Auto-filled fields -->
                <x-input.text label="Item Code" model="item.item_code" readonly />
                <x-input.text label="Item Name" model="item.item_name" readonly />
                <x-input.text label="HSN Code" model="item.hsn" readonly />

                <x-input.text label="Quantity" model="item.quantity" readonly />
                <x-input.text label="Gross Weight (g)" model="item.gross_weight" readonly />
                <x-input.text label="Stone Weight (g)" model="item.stone_weight" readonly />
                <x-input.text label="Diamond Weight (g)" model="item.diamond_weight" readonly />
                <x-input.text label="Net Weight (g)" model="item.net_weight" readonly />
                <x-input.text.label="Net Amount (₹)" model="item.net_amount" readonly />
                <x-input.text label="Total Amount (₹)" model="item.total_amount" readonly />

            </div>

            {{-- <!-- Taxes -->
            <div class="border-t pt-4 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <template x-if="item.intraState">
                    <div class="grid grid-cols-2 gap-4 col-span-full">
                        <div>
                            <div class="text-xs text-gray-500">CGST</div>
                            <div x-text="item.cgst" class="font-medium"></div>
                        </div>

                        <div>
                            <div class="text-xs text-gray-500">SGST</div>
                            <div x-text="item.sgst" class="font-medium"></div>
                        </div>
                    </div>
                </template>

                <template x-if="!item.intraState">
                    <div>
                        <div class="text-xs text-gray-500">IGST</div>
                        <div x-text="item.igst" class="font-medium"></div>
                    </div>
                </template>

            </div> --}}

            <!-- Footer -->
            <div class="flex justify-end gap-3 pt-4 border-t">

                <x-secondary-button type="button" @click="open = false"
                    class="hover:bg-gray-200/60 dark:hover:bg-gray-700/60">
                    Cancel
                </x-secondary-button>

                <button type="submit"
                    class="rounded-md bg-purple-600 px-5 py-2.5 text-white text-sm font-medium
                           hover:bg-purple-700 transition-colors shadow">
                    Add to Sales
                </button>
            </div>

        </form>

    </div>
</div>
