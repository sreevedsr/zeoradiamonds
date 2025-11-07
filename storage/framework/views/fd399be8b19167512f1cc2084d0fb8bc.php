<div class="rounded-lg bg-white p-6 dark:bg-gray-800 sm:p-8 text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-transparent shadow-none dark:shadow-md dark:shadow-gray-900/50"
    x-init="enableSequentialInput();
    focusFirstInput();">

    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Invoice No. <span class="text-red-500">*</span>
            </label>
            <input type="text" name="invoice_no" x-model="invoice_no" tabindex="1"
                value="<?php echo e(old('invoice_no', $nextInvoiceNo ?? '')); ?>" placeholder="Enter invoice number"
                class="input-field w-full rounded-md border border-gray-300 px-3 py-2
                       focus:outline-none focus:ring-2 focus:ring-purple-600
                       dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
        </div>

        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Date <span class="text-red-500">*</span>
            </label>
            <input type="date" name="invoice_date" tabindex="2"
                value="<?php echo e(old('invoice_date', now()->toDateString())); ?>" readonly
                class="input-field w-full cursor-not-allowed rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-gray-700
                       focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
        </div>

        <div x-data="searchableDropdown({
            apiUrl: '<?php echo e(route('dropdown.fetch', ['type' => 'suppliers'])); ?>',
            optionLabel: 'name',
            optionValue: 'id'
        })" x-init="init()" class="relative" @click.outside="open = false">

            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Supplier (Name / Code)
            </label>

            <!-- Focusable input (for sequential input) -->
            <input type="text" x-model="searchQuery" @input="filterOptions()" @focus="open = true"
                @keydown.enter.prevent="
            if (filteredOptions.length > 0) {
                select(filteredOptions[0]);
                // 🔹 Move to next focusable input
                const focusables = Array.from(document.querySelectorAll('input, select, textarea, button'));
                const currentIndex = focusables.indexOf($el);
                if (currentIndex >= 0 && focusables[currentIndex + 1]) {
                    focusables[currentIndex + 1].focus();
                }
            }
        "
                tabindex="3" placeholder="Search supplier"
                class="input-field w-full rounded-md border border-gray-300 px-3 py-2
               focus:outline-none focus:ring-2 focus:ring-purple-600
               dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100
               hover:border-purple-400 transition duration-150" />

            <!-- Dropdown container -->
            <div x-show="open" x-transition
                class="absolute z-10 mt-1 w-full max-h-60 overflow-y-auto rounded-md
               bg-white dark:bg-gray-800 shadow-lg custom-scrollbar
               border-0">

                <template x-if="filteredOptions.length > 0">
                    <ul>
                        <template x-for="option in filteredOptions" :key="option[optionValue]">
                            <li @click="select(option)" tabindex="0" @keydown.enter.prevent="select(option)"
                                class="cursor-pointer px-3 py-2 text-sm
                               hover:bg-purple-100 dark:hover:bg-purple-700/40
                               dark:text-gray-100 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                <div class="flex justify-between items-center">
                                    <span x-text="option.name"></span>
                                    <span class="text-xs text-gray-500 ml-1"
                                        x-text="'(' + option.supplier_code + ')'"></span>
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

            <input type="hidden" name="supplier_id" :value="selected ? selected.id : ''">
        </div>

        
        <div x-data="searchableDropdown({
            apiUrl: '<?php echo e(route('dropdown.fetch', ['type' => 'staff'])); ?>',
            optionLabel: 'name',
            optionValue: 'id'
        })" x-init="init()" class="relative" @click.outside="open = false">

            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Staff <span class="text-red-500">*</span>
            </label>

            <!-- Search input (keyboard focusable + Enter select) -->
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
                tabindex="4" placeholder="Search or select staff" required
                class="input-field w-full rounded-md border border-gray-300 px-3 py-2
               focus:outline-none focus:ring-2 focus:ring-purple-600
               dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100
               hover:border-purple-400 transition duration-150" />

            <!-- Dropdown results -->
            <div x-show="open" x-transition
                class="absolute z-10 mt-1 w-full max-h-60 overflow-y-auto rounded-md
               bg-white dark:bg-gray-800 shadow-lg custom-scrollbar border-0">

                <template x-if="filteredOptions.length > 0">
                    <ul>
                        <template x-for="option in filteredOptions" :key="option[optionValue]">
                            <li @click="select(option)" tabindex="0" @keydown.enter.prevent="select(option)"
                                class="cursor-pointer px-3 py-2 text-sm
                               hover:bg-purple-100 dark:hover:bg-purple-700/40
                               dark:text-gray-100 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                <div class="flex justify-between items-center">
                                    <span x-text="option.name"></span>
                                    <span class="text-xs text-gray-500 ml-1"
                                        x-text="option.code ? '(' + option.code + ')' : '(' + option.id + ')'"></span>
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

            <!-- Hidden input for backend -->
            <input type="hidden" name="staff_id" :value="selected ? selected.id : ''">
        </div>


    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/purchases/partials/header-section.blade.php ENDPATH**/ ?>