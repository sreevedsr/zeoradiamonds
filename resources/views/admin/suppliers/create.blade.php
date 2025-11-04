<x-app-layout>
    @slot('title', 'Supplier Registration')

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Supplier Registration
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

            <!-- Supplier Registration Form -->
            <form method="POST" action="{{ route('admin.suppliers.store') }}">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Supplier Code -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Supplier Code <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="supplier_code" placeholder="Enter supplier code" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- Supplier Name -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Supplier Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" placeholder="Enter supplier name" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Address
                        </label>
                        <textarea name="address" rows="3" placeholder="Enter full address"
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"></textarea>
                    </div>

                    <!-- Phone No -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Phone No. <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="phone" placeholder="Enter phone number" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- State Code -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            State Code
                        </label>
                        <input type="text" name="state_code" placeholder="Enter state code"
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- State -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            State
                        </label>
                        <input type="text" name="state" placeholder="Enter state name"
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- GST No -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            GST No.
                        </label>
                        <input type="text" name="gst_no" placeholder="Enter GST number"
                            class="w-full rounded-md border border-gray-300 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-purple-600
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
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
