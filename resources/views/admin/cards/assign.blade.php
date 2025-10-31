<x-app-layout>
    @slot('title', 'Zeeyame - Diamond Certificates')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Manage Diamond Certificates
    </h2>

    <!-- Assign Certificate Section -->
    <div class="mx-auto mb-8 max-w-5xl rounded-lg bg-white p-6 shadow dark:bg-gray-800">
        <h3 class="mb-6 text-xl font-semibold text-gray-700 dark:text-gray-200">
            Assign a Diamond Certificate
        </h3>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 rounded-md border border-green-300 bg-green-100 p-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif
        @if (session('info'))
            <div class="mb-4 rounded-md border border-green-300 bg-green-100 p-3 text-green-700">
                {{ session('info') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.cards.assign') }}" class="space-y-6" x-data="{
            merchantSearch: '',
            cardSearch: '',
            selectedMerchant: null,
            selectedCard: null
        }">
            @csrf

            <div class="grid grid-cols-1 gap-6 rounded-xl md:grid-cols-2">
                <!-- Merchant Selection -->
                <div
                    class="overflow-hidden rounded-xl bg-white shadow-sm transition-all duration-200 hover:shadow-md dark:bg-gray-800">

                    <div class="border-b border-gray-100 p-5 dark:border-gray-700">
                        <h3 class="mb-2 flex items-center gap-2 text-lg font-semibold text-gray-800 dark:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5 text-purple-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            Select Merchant
                        </h3>
                    </div>

                    <div class="p-5">
                        <div class="relative mb-4">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" x-model="merchantSearch" placeholder="Search merchant..."
                                class="w-full rounded-lg border border-gray-300 py-3 pl-10 pr-4 transition-all duration-200 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                        </div>

                        <!-- Merchants List -->
                        <div class="custom-scrollbar max-h-64 space-y-3 overflow-y-auto p-2">
                            @foreach ($merchants as $merchant)
                                <template
                                    x-if="'{{ strtolower($merchant->name . ' ' . $merchant->business_name) }}'.includes(merchantSearch.toLowerCase())
">
                                    <div @click="selectedMerchant === {{ $merchant->id }} ? selectedMerchant = null : selectedMerchant = {{ $merchant->id }}"
                                        :class="selectedMerchant === {{ $merchant->id }} ?
                                            'border-purple-500 bg-purple-50 dark:bg-purple-900/30' :
                                            'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800'"
                                        class="mb-2 cursor-pointer rounded-lg border p-4 transition-all duration-200 hover:shadow-md">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="font-semibold text-gray-800 dark:text-gray-200">
                                                    {{ $merchant->name }}
                                                </h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $merchant->business_name }}
                                                </p>
                                            </div>
                                            <template x-if="selectedMerchant === {{ $merchant->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            @endforeach
                        </div>

                        <!-- Reset button (appears when selected) -->
                        <div class="mt-4" x-show="selectedMerchant" x-transition>
                            <button type="button" @click="selectedMerchant = null"
                                class="rounded-md bg-gray-200 px-4 py-2 text-sm text-gray-800 transition hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                Unselect Merchant
                            </button>
                        </div>
                    </div>

                    <!-- Hidden input for selected merchant -->
                    <input type="hidden" name="merchant_id" :value="selectedMerchant">
                </div>

                <!-- Card Selection -->
                <div
                    class="overflow-hidden rounded-xl bg-white shadow-sm transition-all duration-200 hover:shadow-md dark:bg-gray-800">

                    <div class="border-b border-gray-100 p-5 dark:border-gray-700">
                        <h3 class="mb-2 flex items-center gap-2 text-lg font-semibold text-gray-800 dark:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5 text-purple-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Select Card
                        </h3>
                    </div>

                    <div class="p-5">
                        <!-- Search -->
                        <div class="relative mb-4">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" x-model="cardSearch" placeholder="Search card..."
                                class="w-full rounded-lg border border-gray-300 py-3 pl-10 pr-4 transition-all duration-200 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                        </div>

                        <!-- Cards List -->
                        <div class="custom-scrollbar grid max-h-64 w-full grid-cols-2 gap-3 overflow-y-auto p-2">
                            @foreach ($cards as $card)
                                <template
                                    x-if="'{{ strtolower($card->card_number . ' ' . $card->clarity . ' ' . $card->color . ' ' . $card->cut . ' ' . $card->certificate_id) }}'
        .includes(cardSearch.toLowerCase())">

                                    <div @click="selectedCard === {{ $card->id }} ? selectedCard = null : selectedCard = {{ $card->id }}"
                                        :class="selectedCard === {{ $card->id }} ?
                                            'border-purple-500 ring-2 ring-purple-400 ring-offset-2 bg-purple-50 dark:bg-purple-900/30 dark:ring-offset-gray-900' :
                                            'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800'"
                                        class="relative cursor-pointer rounded-lg border p-4 transition-all duration-200 hover:border-purple-300 hover:shadow-md">

                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h4 class="font-semibold text-gray-800 dark:text-gray-200">
                                                    Card #{{ $card->certificate_id }}
                                                </h4>
                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $card->card_number }}
                                                </p>
                                            </div>
                                            <span
                                                class="rounded-full bg-purple-100 px-2 py-1 text-sm font-semibold text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                {{ $card->carat_weight }}ct
                                            </span>
                                        </div>

                                        <div class="mt-2 flex flex-wrap gap-2">
                                            <span
                                                class="rounded bg-gray-100 px-2 py-1 text-xs text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                                {{ $card->clarity }}
                                            </span>
                                            <span
                                                class="rounded bg-gray-100 px-2 py-1 text-xs text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                                {{ $card->color }}
                                            </span>
                                            <span
                                                class="rounded bg-gray-100 px-2 py-1 text-xs text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                                {{ $card->cut }}
                                            </span>
                                            <template x-if="selectedCard === {{ $card->id }}">
                                                <div class="right-3 top-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-6 w-6 text-purple-600" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                            </template>
                                        </div>

                                    </div>
                                </template>
                            @endforeach
                        </div>

                        <!-- Unselect button -->
                        <div class="mt-4" x-show="selectedCard" x-transition>
                            <button type="button" @click="selectedCard = null"
                                class="rounded-md bg-gray-200 px-4 py-2 text-sm text-gray-800 transition hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                Unselect Card
                            </button>
                        </div>
                    </div>

                    <!-- Hidden input for selected card -->
                    <input type="hidden" name="card_id" :value="selectedCard" required>
                </div>

            </div>

            <style>
                .custom-scrollbar::-webkit-scrollbar {
                    width: 6px;
                }

                .custom-scrollbar::-webkit-scrollbar-track {
                    background: #f1f5f9;
                    border-radius: 3px;
                }

                .custom-scrollbar::-webkit-scrollbar-thumb {
                    background: #c7d2fe;
                    border-radius: 3px;
                }

                .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                    background: #a5b4fc;
                }

                .dark .custom-scrollbar::-webkit-scrollbar-track {
                    background: #374151;
                }

                .dark .custom-scrollbar::-webkit-scrollbar-thumb {
                    background: #4b5563;
                }

                .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                    background: #6b7280;
                }
            </style>

            <div class="flex justify-end">
                <button type="submit"
                    class="rounded-md bg-purple-600 px-6 py-2 text-white transition duration-150 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    Assign Card
                </button>
            </div>
        </form>

    </div>

    <!-- Diamond Certificates Table -->
    <x-table :headers="['Certificate No', 'Merchant', 'Carat', 'Clarity', 'Color', 'Cut', 'Assigned Date']" :from="$cards->firstItem()" :to="$cards->lastItem()" :total="$cards->total()" :pages="range(1, $cards->lastPage())" :current="$cards->currentPage()"
        :route="route('admin.cards.assign')" searchPlaceholder="Search certificates...">

        @forelse ($cards as $card)
            <tr class="border-b hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-700">
                <td class="px-4 py-3">{{ $card->certificate_id }}</td>
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
