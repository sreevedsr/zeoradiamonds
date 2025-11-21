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
                optionValue: 'id'
            })" x-init="init()" class="relative mt-8" @click.outside="open = false">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    Select Merchant (Name / Code)
                </label>

                <!-- Search Input -->
                <div class="relative md:w-1/2">
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

                <!-- Merchant Details Card (Compact Layout With Dummy SVGs) -->
                <template x-if="selected">
                    <div
                        class="mt-4 rounded-xl border border-gray-200 dark:border-gray-700
        px-5 py-6 shadow-sm dark:shadow-md
        transition-all duration-300 space-y-5 ">

                        <!-- Header -->
                        <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                            <div class="h-8 w-8 flex items-center justify-center text-purple-600 dark:text-purple-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-user-round-icon lucide-user-round">
                                    <circle cx="12" cy="8" r="5" />
                                    <path d="M20 21a8 8 0 0 0-16 0" />
                                </svg>
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 tracking-tight">
                                Merchant Details
                            </h3>
                        </div>

                        <!-- Details Grid -->
                        <div class="grid grid-cols-2 gap-x-8 gap-y-5 text-[15px] leading-relaxed">

                            <!-- Code -->
                            <div class="flex items-between gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-tag-icon lucide-tag">
                                    <path
                                        d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z" />
                                    <circle cx="7.5" cy="7.5" r=".5" fill="currentColor" />
                                </svg>

                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200 text-base">Merchant Code
                                    </p>
                                    <p class="text-gray-700 dark:text-gray-400 mt-1"
                                        x-text="selected.merchant_code || '-'"></p>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-user-icon lucide-user">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>

                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200 text-base">Name</p>
                                    <p class="text-gray-700 dark:text-gray-400 mt-1" x-text="selected.name || '-'">
                                    </p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-phone-icon lucide-phone">
                                    <path
                                        d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                                </svg>

                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200 text-base">Phone</p>
                                    <p class="text-gray-700 dark:text-gray-400 mt-1" x-text="selected.phone || '-'">
                                    </p>
                                </div>
                            </div>

                            <!-- GST -->
                            <div class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-book-text-icon lucide-book-text">
                                    <path
                                        d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20" />
                                    <path d="M8 11h8" />
                                    <path d="M8 7h6" />
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200 text-base">GST No.</p>
                                    <p class="text-gray-700 dark:text-gray-400 mt-1" x-text="selected.gst_no || '-'">
                                    </p>
                                </div>
                            </div>

                            <!-- State -->
                            <div class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-map-icon lucide-map">
                                    <path
                                        d="M14.106 5.553a2 2 0 0 0 1.788 0l3.659-1.83A1 1 0 0 1 21 4.619v12.764a1 1 0 0 1-.553.894l-4.553 2.277a2 2 0 0 1-1.788 0l-4.212-2.106a2 2 0 0 0-1.788 0l-3.659 1.83A1 1 0 0 1 3 19.381V6.618a1 1 0 0 1 .553-.894l4.553-2.277a2 2 0 0 1 1.788 0z" />
                                    <path d="M15 5.764v15" />
                                    <path d="M9 3.236v15" />
                                </svg>

                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200 text-base">State</p>
                                    <p class="text-gray-700 dark:text-gray-400 mt-1" x-text="selected.state || '-'">
                                    </p>
                                </div>
                            </div>

                            {{-- <!-- Tax Type -->
                            <div class="flex items-start gap-3">
                                <!-- Dummy Percent Icon -->
                                <svg class="w-5 h-5 mt-1 text-gray-600 dark:text-gray-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 19l14-14M6 6h.01M18 18h.01" />
                                </svg>

                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200 text-base">Tax Type</p>
                                    <p class="text-gray-700 dark:text-gray-400 mt-1" x-text="$taxType()"></p>
                                </div>
                            </div> --}}

                            <!-- Address -->
                            <div class=" flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-house-icon lucide-house">
                                    <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                                    <path
                                        d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                </svg>

                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200 text-base">Address</p>
                                    <p class="text-gray-700 dark:text-gray-400 mt-1 leading-snug"
                                        x-text="selected.address || '-'"></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </template>

            </div>
        </div>

        {{-- Sales Items Section --}}
        <div
            class="rounded-lg bg-white dark:bg-gray-800 p-8 border border-gray-200 dark:border-transparent
           text-gray-900 dark:text-gray-100 shadow-sm dark:shadow-md dark:shadow-gray-900/50 mb-6">

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
                            {{-- <th class="px-4 py-2 text-left text-sm font-medium">Barcode</th> --}}
                            <th class="px-4 py-2 text-left text-sm font-medium">Product Code</th>
                            <th class="px-4 py-2 text-sm font-medium">Qty</th>
                            <th class="px-4 py-2 text-sm font-medium">Net Wt</th>
                            <th class="px-4 py-2 text-sm font-medium">Net Amount</th>
                            <th class="px-4 py-2 text-right text-sm font-medium">Total</th>
                            <th class="px-4 py-2 text-right text-sm font-medium">Action</th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                        <!-- If items available -->
                        <template x-if="items.length > 0">
                            <template x-for="(row, index) in items" :key="row.id">
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-2 text-sm" x-text="index + 1"></td>
                                    <td x-text="row.product_code"></td>
                                    {{-- <td x-text="row.product?.item_name"></td> --}}
                                    <td class="px-4 py-2 text-sm" x-text="row.quantity"></td>
                                    <td class="px-4 py-2 text-sm" x-text="row.net_weight"></td>
                                    <td class="px-4 py-2 text-sm" x-text="row.net_amount"></td>
                                    <td class="px-4 py-2 text-right text-sm" x-text="row.total_amount"></td>
                                    <td class="px-4 py-2 text-right">
                                        <x-danger-button type="button" @click="openDeleteModal(row.id)">
                                            Delete
                                        </x-danger-button>
                                    </td>
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
    {{-- Reusable Delete Confirmation Modal --}}
    <x-modal name="confirm-delete-modal" focusable>
        <div class="p-6" x-data>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Confirm Delete
            </h2>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Are you sure you want to delete this item?
            </p>

            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button x-on:click="$dispatch('confirm-delete')">
                    {{ __('Yes, Delete') }}
                </x-danger-button>
            </div>
        </div>
    </x-modal>


</x-app-layout>
