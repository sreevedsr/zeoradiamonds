<x-app-layout>
    @slot('title', 'Zeeyame - Assign Diamond Certificates')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Assign Diamond Certificates
    </h2>

    <!-- Success Message -->

    <!-- Assign Card Form -->
    <div class="space-y-6">
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-200 text-green-800 rounded max-w-4xl mx-auto">
                        {{ session('success') }}
                    </div>
                @endif
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Assign a Card to Merchant</h3>
                <form action="{{ route('admin.cards.assign') }}" method="POST" class="space-y-6">
                    @csrf
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
                    <!-- Diamond Details -->
                    <div>
                        <label for="card_number" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                            Card Number
                        </label>
                        <input type="text" name="card_number" id="card_number" required
                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="carat_weight" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Carat Weight
                            </label>
                            <input type="number" step="0.01" name="carat_weight" id="carat_weight" required
                                class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                       dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        </div>
                        <div>
                            <label for="clarity" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Clarity
                            </label>
                            <input type="text" name="clarity" id="clarity" required
                                class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                       dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        </div>
                        <div>
                            <label for="color" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                                Color
                            </label>
                            <input type="text" name="color" id="color" required
                                class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                       dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        </div>
                    </div>
                    <div>
                        <label for="cut" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                            Cut
                        </label>
                        <input type="text" name="cut" id="cut" required
                            class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700
                                   focus:outline-none focus:ring-2 focus:ring-purple-500">
                            Assign Card
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Existing Diamond Cards -->
    {{-- <div class="max-w-7xl mx-auto grid">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Available Diamond Cards</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            {{-- @foreach ($cards as $card) --}}
                {{-- <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden flex flex-col">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200">
                            {{ $card->diamond_type }} --}}
                        {{-- </h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $card->carat_weight }} ct | {{ $card->color }} | {{ $card->clarity }}
                        </p>
                    </div>

                    <div class="flex justify-center items-center p-4 h-32">
                        <img src="{{ $card->image_url ?? 'https://via.placeholder.com/150' }}"
                            alt="Diamond" class="h-full object-contain">
                    </div>

                    <div class="p-4">
                        <form action="/" method="POST">
                            @csrf
                            <div class="flex items-center gap-3">
                                <select name="merchant_id" required
                                    class="flex-1 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                           dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                                    <option value="" disabled selected>Assign to...</option>
                                    {{-- @foreach ($merchants as $merchant)
                                        <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                    @endforeach --}}
                                {{-- </select>

                                <button type="submit"
                                    class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700
                                           focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    Assign
                                </button>
                            </div>
                        </form>
                    </div>
                </div> --}}
            {{-- @endforeach --}}
        {{-- </div> --}}
    {{-- </div>  --}}

</x-app-layout>
