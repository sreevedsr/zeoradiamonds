<x-app-layout>
    @slot('title', 'Zeeyame - Add Customer')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Customer
    </h2>

    <!-- Customer Form Section -->
    <div class="space-y-6">
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl text-gray-900 dark:text-gray-100">
                @if (session('success'))
                    <div class="mb-4 text-green-500 font-semibold">
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

                <form method="POST" action="{{ route('merchant.customers.store') }}" class="space-y-4">
                    @csrf

                    <!-- Customer Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Customer Name</label>
                        <input type="text" name="name"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter full name" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                        <input type="email" name="email"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter email address" required>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Phone Number</label>
                        <input type="text" name="phone"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter phone number" required>
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Address</label>
                        <textarea name="address"
                                  class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                                  placeholder="Enter full address" rows="3" required></textarea>
                    </div>

                    <!-- Optional: Other fields like city, state, etc. -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">City</label>
                        <input type="text" name="city"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter city" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">State</label>
                        <input type="text" name="state"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               placeholder="Enter state" required>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors duration-150">
                        Save Customer
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
