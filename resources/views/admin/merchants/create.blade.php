<x-app-layout>
    @slot('title', 'Zeeyame - Add Merchant')

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Merchant
    </h2>

    <div class="mx-auto">
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

            <form action="{{ route('admin.merchants.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Owner Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Owner Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            placeholder="Enter shop owner's name"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600
                                   hover:border-purple-400 transition duration-150">
                    </div>

                    <!-- Business Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Business Name</label>
                        <input type="text" name="business_name" value="{{ old('business_name') }}" required
                            placeholder="Enter business or shop name"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600
                                   hover:border-purple-400 transition duration-150">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Shop Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="Enter shop email address"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600
                                   hover:border-purple-400 transition duration-150">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Shop Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                            placeholder="Enter shop phone number"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600
                                   hover:border-purple-400 transition duration-150">
                    </div>

                    <!-- Address (Full Width) -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <textarea name="address" rows="3" required
                            placeholder="Enter full shop address"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600
                                   hover:border-purple-400 transition duration-150">{{ old('address') }}</textarea>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-start pt-4">
                    <button type="submit"
                        class="mt-4 px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700
                               focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-150">
                        Add Merchant
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
