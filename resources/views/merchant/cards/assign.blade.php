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
                <form action="{{ route('merchant.assignCard') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Select Customer -->
                        {{-- <div>
                            <label for="customer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Select Customer
                            </label>
                            <select name="customer_id" id="customer_id" required
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 border-gray-300 rounded-md focus:border-purple-400 focus:ring focus:ring-purple-300 focus:ring-opacity-50">
                                <option value="" disabled selected>Choose customer</option>
                                {{-- @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach --}}
                        {{-- </select> --}}
                        {{-- </div>  --}}
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
                            </select>
                        </div>



                        <!-- Select Card -->
                        <div class="mb-6">
                            <label for="card_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Select Certificate
                            </label>
                            <select name="card_id" id="card_id" required
                                class="block w-full px-3 py-2 text-sm bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200
               border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
               focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition ease-in-out duration-200">
                                {{-- <option value="" disabled selected>Choose certificate</option> --}}
                                {{-- @foreach ($cards as $card) --}}
                                {{-- <option value=""> --}}
                                    {{-- {{ $card->certificate_id }} — {{ $card->diamond_type }} ({{ $card->carat_weight }} ct) --}}
                                {{-- </option> --}}
                                <option value="" disabled selected>-- Select Certificate --</option>
                                <option value="1">Certificate 1 </option>
                                <option value="2">Certificate 2</option>
                                {{-- @endforeach --}}
                            </select>
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
</x-app-layout>
