<x-app-layout>
    @slot('title', 'Zeeyame - Add Customer')

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Customer
    </h2>

    <div class=" mx-auto">
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            @if (session('success'))
                <div class="mb-4 text-green-600 font-medium bg-green-100 border border-green-300 rounded-md p-3">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-500 font-semibold">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('merchant.customers.store') }}" class="space-y-6">
                @csrf

                <!-- Two Column Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Customer Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required
                            placeholder="Enter full name"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" required
                            placeholder="Enter email address"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" required
                            placeholder="Enter phone number"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>

                    <!-- City -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                        <input type="text" name="city"
                            placeholder="Enter city"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>

                    <!-- State -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">State</label>
                        <input type="text" name="state"
                            placeholder="Enter state"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>

                    <!-- Address (full width) -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <textarea name="address" rows="3"
                            placeholder="Enter full address"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600"></textarea>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-start pt-4">
                    <button type="submit"
                        class="mt-4 px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700
                               focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-150">
                        Save Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
