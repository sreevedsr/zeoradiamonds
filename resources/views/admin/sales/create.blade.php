<x-app-layout>
    @slot('title', 'Upload Sales Details (B2B)')

    <form method="POST" action="{{ route('admin.products.assign') }}" enctype="multipart/form-data" x-data="purchaseForm()"
        x-init="enableSequentialInput(document, '#add-sale-item-btn');
        focusFirstInput();">
        @csrf

        <div class="space-y-8">

            {{-- Sales Header Section --}}
            <div
                class="rounded-lg bg-white dark:bg-gray-800 p-8 border border-gray-200 dark:border-transparent
                text-gray-900 dark:text-gray-100 shadow-none dark:shadow-md dark:shadow-gray-900/50">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-3">
                    <!-- Entry No (Auto) -->
                    <div>
                        <label class="text-sm font-medium">Entry No.</label>
                        <x-input.text type="text" name="entry_no" value="{{ $nextEntryNo ?? 'AUTO' }}" readonly
                            class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300" />
                    </div>

                    <!-- Date (Auto) -->
                    <div>
                        <label class="text-sm font-medium">Date</label>
                        <x-input.text type="text" name="date" value="{{ now()->format('d-m-Y') }}" readonly
                            class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300" />
                    </div>

                    <!-- Invoice No -->
                    <div>
                        <label class="text-sm font-medium">Invoice No.</label>
                        <x-input.text type="text" name="invoice_no" placeholder="Enter Invoice No"
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-purple-500" />
                    </div>

                    <!-- Merchant Dropdown -->
                    <div x-data="searchableDropdown({
                        apiUrl: '{{ route('admin.dropdown.fetch', ['type' => 'merchants']) }}',
                        optionLabel: 'name',
                        optionValue: 'id'
                    })" x-init="init()" class="relative col-span-1"
                        @click.outside="open = false">

                        <!-- Label -->
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Select Merchant (Name / Code)
                        </label>

                        <!-- Searchable input -->
                        <input type="text" x-model="searchQuery" @input="filterOptions()" @focus="open = true"
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
                            tabindex="3" placeholder="Search merchant..."
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2
               focus:outline-none focus:ring-2 focus:ring-purple-600
               dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100
               hover:border-purple-400 transition duration-150" />

                        <!-- Dropdown List -->
                        <div x-show="open" x-transition
                            class="absolute z-10 mt-1 w-full max-h-60 overflow-y-auto rounded-md
               bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700">
                            <template x-if="filteredOptions.length > 0">
                                <ul>
                                    <template x-for="option in filteredOptions" :key="option[optionValue]">
                                        <li @click="select(option)" tabindex="0"
                                            @keydown.enter.prevent="select(option)"
                                            class="cursor-pointer px-3 py-2 text-sm
                               hover:bg-purple-100 dark:hover:bg-purple-700/40
                               dark:text-gray-100 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                            <span x-text="option.name"></span>
                                            <span class="text-xs text-gray-500 ml-1"
                                                x-text="'(' + option.merchant_code + ')'"></span>
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

                        <!-- Hidden Fields -->
                        <input type="hidden" name="merchant_id" :value="selected ? selected.id : ''">
                        <input type="hidden" name="merchant_state" :value="selected ? selected.state : ''">

                        <!-- Read-only Merchant Details -->
                        <template x-if="selected">
                            <div class="mt-5 rounded-xl border border-gray-200 dark:border-gray-700 dark:bg-gray-800/60
                   shadow-sm p-5 text-sm text-gray-700 dark:text-gray-100 dark:shadow-md space-y-2 transition-all duration-300 ease-in-out"
                                x-transition.opacity.duration.300ms>
                                <h3
                                    class="font-semibold text-gray-900 dark:text-white text-base flex items-center gap-2 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Merchant Details
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                    <div>
                                        <span class="font-medium text-gray-800 dark:text-gray-300">Merchant Code:</span>
                                        <div x-text="selected.merchant_code || '-'"></div>
                                    </div>

                                    <div>
                                        <span class="font-medium text-gray-800 dark:text-gray-300">Merchant Name:</span>
                                        <div x-text="selected.name || '-'"></div>
                                    </div>

                                    <div>
                                        <span class="font-medium text-gray-800 dark:text-gray-300">Email:</span>
                                        <div x-text="selected.email || '-'"></div>
                                    </div>

                                    <div>
                                        <span class="font-medium text-gray-800 dark:text-gray-300">Phone No.:</span>
                                        <div x-text="selected.phone || '-'"></div>
                                    </div>

                                    <div>
                                        <span class="font-medium text-gray-800 dark:text-gray-300">GST No.:</span>
                                        <div x-text="selected.gst_no || '-'"></div>
                                    </div>

                                    <div>
                                        <span class="font-medium text-gray-800 dark:text-gray-300">State Code:</span>
                                        <div x-text="selected.state_code || '-'"></div>
                                    </div>

                                    <div>
                                        <span class="font-medium text-gray-800 dark:text-gray-300">State:</span>
                                        <div x-text="selected.state || '-'"></div>
                                    </div>

                                    <div class="md:col-span-2 lg:col-span-3">
                                        <span class="font-medium text-gray-800 dark:text-gray-300">Address:</span>
                                        <div class="leading-snug" x-text="selected.address || '-'"></div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                </div>
            </div>

            {{-- Sales Items Section --}}
            <div
                class="rounded-lg bg-white dark:bg-gray-800 p-8 border border-gray-200 dark:border-transparent
                text-gray-900 dark:text-gray-100 shadow-none dark:shadow-md dark:shadow-gray-900/50">

                <!-- Section Header -->
                <div class="flex items-center justify-between mb-4 border-b border-gray-200 dark:border-gray-700 pb-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Items Sold</h3>

                    <button type="button" id="add-sale-item-btn" tabindex="5" @click="$store.purchaseModal.open()"
                        class="flex items-center gap-2 rounded-md bg-purple-600 px-4 py-2 text-white text-sm
                        hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Item
                    </button>
                </div>

                <!-- Items Table -->
                <div class="overflow-x-auto rounded-lg border border-gray-100 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">#
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Barcode</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Item Name</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300">Qty</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300">Net Wt</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300">Net Amount
                                </th>
                                <th class="px-4 py-2 text-right text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Total</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700"
                            x-show="$store.purchaseModal.items.length">
                            <template x-for="(item, index) in $store.purchaseModal.items" :key="index">
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-2 text-sm" x-text="index + 1"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.barcode"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.item_name"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.quantity"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.net_weight"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.net_amount"></td>
                                    <td class="px-4 py-2 text-right" x-text="item.total_amount"></td>
                                </tr>
                            </template>
                        </tbody>

                        <tbody x-show="!$store.purchaseModal.items.length">
                            <tr>
                                <td colspan="7"
                                    class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 text-sm">
                                    No items added yet. Click “Add Item” to begin.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="flex justify-between items-center mt-6">
                    <div class="text-gray-700 dark:text-gray-200 text-sm">
                        <span>Total Items:</span>
                        <span x-text="$store.purchaseModal.items.length"></span>
                    </div>

                    <x-primary-button type="submit">Submit Sales</x-primary-button>
                </div>

                <input type="hidden" name="items_json" :value="JSON.stringify($store.purchaseModal.items)">
            </div>
        </div>
    </form>

    {{-- Add Item Modal (reuses same pattern as purchase) --}}
    @include('admin.sales.partials.add-item-modal')
</x-app-layout>
