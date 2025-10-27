<x-app-layout>
    @slot('title', 'Zeeyame - Assign Diamond Certificates')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Assign Diamond Certificates
    </h2>

    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded-md max-w-4xl mx-auto">
            {{ session('success') }}
        </div>
    @endif

    <!-- Assign Card Form (Full Width) -->
    <div class="max-w-5xl mx-auto">
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-6">
                Assign a Card to Merchant
            </h3>

            <form action="{{ route('admin.cards.assign') }}" method="POST" class="space-y-6">
                @csrf

                <!-- 2 per row layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Merchant Selection -->
                    <div>
                        <label for="merchant_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                            Select Merchant
                        </label>
                        <select name="merchant_id" id="merchant_id" required
                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                            <option value="" disabled selected>-- Choose a Merchant --</option>
                            {{-- @foreach ($merchants as $merchant)
                                <option value="{{ $merchant->id }}">
                                    {{ $merchant->name }} ({{ $merchant->business_name }})
                                </option>
                            @endforeach --}}
                        </select>
                    </div>

                    <!-- Card Number -->
                    <div>
                        <label for="card_number" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                            Card Number
                        </label>
                        <input type="text" name="card_number" id="card_number" required
                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>

                    <!-- Carat Weight -->
                    <div>
                        <label for="carat_weight" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                            Carat Weight
                        </label>
                        <input type="number" step="0.01" name="carat_weight" id="carat_weight" required
                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>

                    <!-- Clarity -->
                    <div>
                        <label for="clarity" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                            Clarity
                        </label>
                        <input type="text" name="clarity" id="clarity" required
                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>

                    <!-- Color -->
                    <div>
                        <label for="color" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                            Color
                        </label>
                        <input type="text" name="color" id="color" required
                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>

                    <!-- Cut -->
                    <div>
                        <label for="cut" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                            Cut
                        </label>
                        <input type="text" name="cut" id="cut" required
                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-start">
                    <button type="submit"
                        class="mt-4 px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700
                               focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-150">
                        Assign Card
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
