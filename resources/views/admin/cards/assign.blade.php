<x-app-layout>
    @slot('title', 'Zeeyame - Diamond Certificates')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Manage Diamond Certificates
    </h2>

    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded-md max-w-4xl mx-auto">
            {{ session('success') }}
        </div>
    @endif

    <!-- Assign Certificate Section -->
    <div class="p-6 mb-8 bg-white dark:bg-gray-800 rounded-lg shadow max-w-5xl mx-auto">
        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-6">
            Assign a Diamond Certificate
        </h3>

        <form method="POST" action="{{ route('admin.cards.assign') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="merchant_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Select Merchant
                    </label>
                    <select name="merchant_id" id="merchant_id" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <option value="" disabled selected>-- Choose a Merchant --</option>
                        @foreach ($merchants as $merchant)
                            <option value="{{ $merchant->id }}">
                                {{ $merchant->name }} ({{ $merchant->business_name }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="card_number" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Card Number
                    </label>
                    <input type="text" name="card_number" id="card_number" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>

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

                <div>
                    <label for="cut" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        Cut
                    </label>
                    <input type="text" name="cut" id="cut" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                               dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700
                           focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-150">
                    Assign Certificate
                </button>
            </div>
        </form>
    </div>

    <!-- Diamond Certificates Table -->
    <x-table :headers="['Card Number', 'Merchant', 'Carat', 'Clarity', 'Color', 'Cut', 'Assigned Date']" :from="$cards->firstItem()" :to="$cards->lastItem()" :total="$cards->total()" :pages="range(1, $cards->lastPage())" :current="$cards->currentPage()"
        :route="route('admin.cards.index')" searchPlaceholder="Search certificates..." >

    @forelse ($cards as $card)
        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
            <td class="px-4 py-3">{{ $card->card_number }}</td>
            <td class="px-4 py-3">{{ $card->merchant ? $card->merchant->name : '—' }}</td>
            <td class="px-4 py-3">{{ $card->carat_weight }}</td>
            <td class="px-4 py-3">{{ $card->clarity }}</td>
            <td class="px-4 py-3">{{ $card->color }}</td>
            <td class="px-4 py-3">{{ $card->cut }}</td>
            <td class="px-4 py-3">{{ $card->created_at->format('d M Y') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                No certificates found.
            </td>
        </tr>
    @endforelse
    </x-table>
</x-app-layout>
