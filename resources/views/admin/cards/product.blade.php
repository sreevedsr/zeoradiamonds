<x-app-layout>
    @slot('title', 'Zeeyame - Product Registration')

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Product Registration
    </h2>

    <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8">
        <div class="mx-auto text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 rounded-md border border-green-300 bg-green-100 p-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 rounded-md border border-red-300 bg-red-100 p-3 text-red-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Product Registration Form -->
            <form method="POST" action="{{ route('admin.products.register') }}">
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
                        <input type="text" name="hsn_code"
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                            placeholder="Enter HSN code" required>
                    </div>

                    <!-- Item Code -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Item Code <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="item_code"
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                            placeholder="Enter item code" required>
                    </div>

                    <!-- Item Name -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Item Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="item_name"
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                            placeholder="Enter item name" required>
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
