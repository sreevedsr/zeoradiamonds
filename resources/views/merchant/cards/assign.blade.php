<x-app-layout>
    @slot('title', 'Zeeyame - Assign Diamond Certificates')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Assign Diamond Certificates
    </h2>

    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-5xl mx-auto text-gray-900 dark:text-gray-100 space-y-8">

            <!-- Success / Error Messages -->
            @if (session('success'))
                <div class="p-3 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="p-3 bg-red-200 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Assignment Form -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Assign Certificate to Customer</h3>

                <form action="{{ route('merchant.cards.assign') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Select Customer -->
                        <div class="mb-6">
                            <label for="customer"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Select Customer
                            </label>
                            <select id="customer" name="customer" required
                                class="block w-full px-3 py-2 text-sm bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200
                    border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                    transition ease-in-out duration-200">
                                <option value="" disabled selected>-- Select Customer --</option>
                                <option value="1">John Doe</option>
                                <option value="2">Jane Smith</option>
                                {{-- @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach --}}
                            </select>
                        </div>

                        <!-- Select Certificate -->
                        <div class="mb-6">
                            <label for="card_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Select Certificate
                            </label>
                            <select name="card_id" id="card_id" required
                                class="block w-full px-3 py-2 text-sm bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200
                    border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                    transition ease-in-out duration-200">
                                <option value="" disabled selected>-- Select Certificate --</option>
                                <option value="1">Certificate 1</option>
                                <option value="2">Certificate 2</option>
                                {{-- @foreach ($cards as $card)
                        <option value="{{ $card->id }}">
                            {{ $card->certificate_id }} — {{ $card->diamond_type }} ({{ $card->carat_weight }} ct)
                        </option>
                    @endforeach --}}
                            </select>
                        </div>

                        <!-- Card Valuation (Auto Fetched) -->
                        <div class="mb-6">
                            <label for="valuation"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Card Valuation
                            </label>
                            <input type="text" id="valuation" name="valuation" readonly
                                class="block w-full px-3 py-2 text-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                    border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                    transition ease-in-out duration-200"
                                placeholder="Auto-fetched from database" />
                        </div>

                        <!-- Price -->
                        <div class="mb-6">
                            <label for="price"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Selling Price
                            </label>
                            <input type="number" step="0.01" id="price" name="price" required
                                class="block w-full px-3 py-2 text-sm bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200
                    border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                    transition ease-in-out duration-200"
                                placeholder="Enter selling price" />
                        </div>

                        <!-- Discount -->
                        <div class="mb-6">
                            <label for="discount"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Discount (%)
                            </label>
                            <input type="number" step="0.1" id="discount" name="discount"
                                class="block w-full px-3 py-2 text-sm bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200
                    border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                    transition ease-in-out duration-200"
                                placeholder="Enter discount percentage" />
                        </div>

                        <!-- Final Price (Auto Calculated) -->
                        <div class="mb-6">
                            <label for="final_price"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Final Price
                            </label>
                            <input type="text" id="final_price" name="final_price" readonly
                                class="block w-full px-3 py-2 text-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                    border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                    transition ease-in-out duration-200"
                                placeholder="Auto-calculated" />
                        </div>
                    </div>

                    <!-- Assign Button -->
                    <div>
                        <button type="submit"
                            class="px-4 my-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400">
                            Assign Certificate
                        </button>
                    </div>
                </form>
            </div>

            <div class="p-6"></div>
            <!-- Assigned Certificates Table -->
            <div>
                <h3 class="text-lg font-semibold my-4">Assigned Certificates</h3>
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Customer</th>
                                <th class="px-4 py-3">Certificate ID</th>
                                <th class="px-4 py-3">Diamond Type</th>
                                <th class="px-4 py-3">Carat Weight</th>
                                <th class="px-4 py-3">Assigned On</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            {{-- @forelse ($assignedCards as $index => $assigned) --}}
                            <tr class="text-gray-700 dark:text-gray-400">
                                {{-- <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $assigned->customer->name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $assigned->card->certificate_id }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $assigned->card->diamond_type }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $assigned->card->carat_weight }} ct</td>
                                    <td class="px-4 py-3 text-sm">{{ $assigned->created_at->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <form action="{{ route('merchant.unassignCard', $assigned->id) }}" method="POST"
                                            onsubmit="return confirm('Unassign this certificate?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline">Unassign</button>
                                        </form> --}}
                                </td>
                            </tr>
                            {{-- @empty --}}
                            {{-- <tr>
                                    <td colspan="7" class="px-4 py-3 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No assigned certificates found.
                                    </td>
                                </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.getElementById('card_id').addEventListener('change', function() {
            // Simulate DB fetch — replace with AJAX route call
            const valuations = {
                1: 50000,
                2: 75000
            };
            const valuationField = document.getElementById('valuation');
            const cardId = this.value;

            valuationField.value = valuations[cardId] ? `₹${valuations[cardId].toLocaleString()}` : '';
        });

        document.getElementById('price').addEventListener('input', calculateFinal);
        document.getElementById('discount').addEventListener('input', calculateFinal);

        function calculateFinal() {
            const price = parseFloat(document.getElementById('price').value) || 0;
            const discount = parseFloat(document.getElementById('discount').value) || 0;
            const final = price - (price * discount / 100);
            document.getElementById('final_price').value = final ? `₹${final.toFixed(2)}` : '';
        }
    </script>

</x-app-layout>
