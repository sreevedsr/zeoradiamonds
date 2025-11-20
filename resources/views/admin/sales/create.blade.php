<x-app-layout>
    @slot('title', 'Upload Sales Details (B2B)')
    <form method="POST" action="{{ route('admin.products.assign') }}" enctype="multipart/form-data" x-data="saleForm()"
        x-init="init();
        enableSequentialInput(document, '#add-sale-item-btn');
        focusFirstInput();">
        @csrf

        {{-- Sales Header Section --}}
        <div
            class="rounded-lg bg-white dark:bg-gray-800 p-8 border border-gray-200 dark:border-transparent
           text-gray-900 dark:text-gray-100 shadow-sm dark:shadow-md dark:shadow-gray-900/50 mb-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Entry No (Auto) -->
                <div>
                    <label class="text-sm font-medium">Entry No.</label>
                    <x-input.text type="text" name="entry_no" value="{{ $nextEntryNo ?? 'AUTO' }}" readonly
                        class="w-full rounded-md border border-gray-300 px-3 py-2
                       bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300" />
                </div>

                <!-- Date (Auto) -->
                <div>
                    <label class="text-sm font-medium">Date</label>
                    <x-input.text type="text" name="date" value="{{ now()->format('d-m-Y') }}" readonly
                        class="w-full rounded-md border border-gray-300 px-3 py-2
                       bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300" />
                </div>

                <!-- Invoice No -->
                <div>
                    <label class="text-sm font-medium">Invoice No.</label>
                    <x-input.text type="text" name="invoice_no" placeholder="Enter Invoice No" required
                        class="input-field w-full rounded-md border border-gray-300 px-3 py-2
                       focus:ring-2 focus:ring-purple-500" />
                </div>
            </div>

            <!-- Merchant Dropdown -->
            <div x-data="searchableDropdown({
                apiUrl: '{{ route('admin.dropdown.fetch', ['type' => 'merchants']) }}',
                optionLabel: 'name',
                optionValue: 'id'})" x-init="init()" class="relative mt-8" @click.outside="open = false">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    Select Merchant (Name / Code)
                </label>

                <!-- Search Input -->
                <div class="relative">
                    <input type="text" x-model="searchQuery" @input="filterOptions()" @focus="open = true"
                        @keydown.enter.prevent="
                    if (filteredOptions.length > 0) {
                        select(filteredOptions[0]);
                        const focusables = Array.from(document.querySelectorAll('input, select, textarea, button'));
                        const currentIndex = focusables.indexOf($el);
                        if (currentIndex >= 0 && focusables[currentIndex + 1]) {
                            focusables[currentIndex + 1].focus();
                        }
                    }"
                        tabindex="3" placeholder="Search merchant..."
                        class="w-full rounded-md border border-gray-300 px-3 py-2
                       focus:outline-none focus:ring-2 focus:ring-purple-600
                       dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100
                       hover:border-purple-400 transition duration-150" />

                    <!-- Dropdown -->
                    <div x-show="open" x-transition
                        class="absolute z-10 mt-1 w-full max-h-60 overflow-y-auto rounded-md
                       bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700">
                        <template x-if="filteredOptions.length > 0">
                            <ul>
                                <template x-for="option in filteredOptions" :key="option[optionValue]">
                                    <li @click="select(option)" tabindex="0" @keydown.enter.prevent="select(option)"
                                        class="cursor-pointer px-3 py-2 text-sm
                                       hover:bg-purple-50 dark:hover:bg-purple-700/30
                                       dark:text-gray-100 border-b border-gray-100 dark:border-gray-700
                                       last:border-0 transition-colors duration-100">
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
                </div>

                <!-- Hidden Fields -->
                <input type="hidden" name="merchant_id" :value="selected ? selected.id : ''">
                <input type="hidden" name="merchant_state" :value="selected ? selected.state : ''">

                <!-- Merchant Details Card -->
                <template x-if="selected">
                    <div class="mt-6 rounded-2xl border border-gray-200 dark:border-gray-700
               bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900
               p-6 shadow-md dark:shadow-lg dark:shadow-gray-900/40
               transition-all duration-300 ease-in-out hover:shadow-lg"
                        x-transition.opacity.duration.300ms>
                        <!-- Header -->
                        <div
                            class="flex items-center justify-between mb-5 border-b border-gray-200 dark:border-gray-700 pb-3">
                            <div class="flex items-center gap-2">
                                <div
                                    class="flex items-center justify-center h-8 w-8 rounded-full bg-purple-100 dark:bg-purple-900/40">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-purple-600 dark:text-purple-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100 tracking-tight">
                                    Merchant Details
                                </h3>
                            </div>

                            <!-- Optional collapse button -->
                            <button type="button" x-on:click="showDetails = !showDetails" x-data="{ showDetails: true }"
                                class="text-sm text-purple-600 dark:text-purple-400 hover:underline" x-show="false">
                                Toggle
                            </button>
                        </div>

                        <!-- Content -->
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-[15px] text-gray-700 dark:text-gray-300 leading-relaxed">
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Code</span>
                                <span class="mt-0.5 text-gray-600 dark:text-gray-400"
                                    x-text="selected.merchant_code || '-'"></span>
                            </div>

                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Name</span>
                                <span class="mt-0.5 text-gray-600 dark:text-gray-400"
                                    x-text="selected.name || '-'"></span>
                            </div>

                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Email</span>
                                <span class="mt-0.5 text-gray-600 dark:text-gray-400 break-all"
                                    x-text="selected.email || '-'"></span>
                            </div>

                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Phone</span>
                                <span class="mt-0.5 text-gray-600 dark:text-gray-400"
                                    x-text="selected.phone || '-'"></span>
                            </div>

                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">GST No.</span>
                                <span class="mt-0.5 text-gray-600 dark:text-gray-400"
                                    x-text="selected.gst_no || '-'"></span>
                            </div>

                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">State Code</span>
                                <span class="mt-0.5 text-gray-600 dark:text-gray-400"
                                    x-text="selected.state_code || '-'"></span>
                            </div>

                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">State</span>
                                <span class="mt-0.5 text-gray-600 dark:text-gray-400"
                                    x-text="selected.state || '-'"></span>
                            </div>

                            <div class="md:col-span-2 lg:col-span-3 flex flex-col">
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Address</span>
                                <span class="mt-0.5 text-gray-600 dark:text-gray-400 leading-snug"
                                    x-text="selected.address || '-'"></span>
                            </div>
                        </div>
                    </div>
                </template>

            </div>
        </div>

        {{-- Sales Items Section --}}
        <div class="rounded-lg bg-white dark:bg-gray-800 p-8 ...">

            <!-- Section Header -->
            <div class="flex items-center justify-between mb-4 ...">
                <h3 class="text-lg font-semibold ...">Items Sold</h3>

                <!-- open modal by dispatching event -->
                <button type="button" id="add-sale-item-btn" tabindex="5"
                    @click="window.dispatchEvent(new CustomEvent('open-sale-modal'))"
                    class="flex items-center gap-2 rounded-md bg-purple-600 px-4 py-2 text-white text-sm
                       hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <!-- icon -->
                    Add Item
                </button>
            </div>

            <!-- Items Table (DB-driven) -->
            <div class="overflow-x-auto rounded-lg ">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium">#</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Barcode</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Item Name</th>
                            <th class="px-4 py-2 text-sm font-medium">Qty</th>
                            <th class="px-4 py-2 text-sm font-medium">Net Wt</th>
                            <th class="px-4 py-2 text-sm font-medium">Net Amount</th>
                            <th class="px-4 py-2 text-right text-sm font-medium">Total</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                        <!-- If items available -->
                        <template x-if="items.length > 0">
                            <template x-for="(row, index) in items" :key="row.id">
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-2 text-sm" x-text="index + 1"></td>
                                    <td class="px-4 py-2 text-sm" x-text="row.barcode"></td>
                                    <td class="px-4 py-2 text-sm" x-text="row.item_name"></td>
                                    <td class="px-4 py-2 text-sm" x-text="row.quantity"></td>
                                    <td class="px-4 py-2 text-sm" x-text="row.net_weight"></td>
                                    <td class="px-4 py-2 text-sm" x-text="row.net_amount"></td>
                                    <td class="px-4 py-2 text-right text-sm" x-text="row.total_amount"></td>
                                </tr>
                            </template>
                        </template>

                        <!-- No items -->
                        <template x-if="items.length === 0">
                            <tr>
                                <td colspan="7"
                                    class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 text-sm">
                                    No items added yet. Click “Add Item” to begin.
                                </td>
                            </tr>
                        </template>
                    </tbody>

                </table>
            </div>

            <!-- Totals (use an instance to show count) -->
            <div class="flex justify-between items-center mt-6">
                <div class="text-gray-700 dark:text-gray-200 text-sm">
                    <span>Total Items:</span>
                    <span x-text="items.length"></span>
                </div>

                <x-primary-button type="submit">Submit Sales</x-primary-button>
            </div>
        </div>
    </form>

    @include('admin.sales.partials.add-item-modal')

</x-app-layout>
