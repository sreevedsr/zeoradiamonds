<x-app-layout>
    @slot('title', 'Product Registration')

    <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8">
        <div class="mx-auto text-gray-900 dark:text-gray-100">

            <!-- Product Registration Form -->
            <form method="POST" action="{{ route('admin.products.register') }}" x-init="init();
            enableSequentialInput();
            $nextTick(() => focusFirstInput());">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- SI. No. -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            SI. No. <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="serial_no" value="{{ $nextSerialNo }}" readonly
                            class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-100 cursor-not-allowed
               focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                            placeholder="Auto-generated">
                    </div>

                    <!-- HSN Code -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            HSN Code <span class="text-red-500">*</span>
                        </label>
                        <x-input.text name="hsn_code" placeholder="Enter HSN code" required />
                    </div>

                    <!-- Item Code -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Item Code <span class="text-red-500">*</span>
                        </label>
                        <x-input.text name="item_code" placeholder="Enter item code" required />
                    </div>

                    <!-- Item Name -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Item Name <span class="text-red-500">*</span>
                        </label>
                        <x-input.text name="item_name" placeholder="Enter item name" required />
                    </div>

                </div>

                <!-- Save Button -->
                <div class="mt-6 text-right">
                    <button type="submit"
                        class="rounded-md bg-purple-600 px-5 py-2 font-medium text-white
                               hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
