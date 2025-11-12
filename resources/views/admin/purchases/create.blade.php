<x-app-layout>
    @slot('title', 'Upload Product Purchase Details')

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" x-data="purchaseForm()"
        x-init="enableSequentialInput(document, '#add-item-btn');
        focusFirstInput();
        $store.purchaseModal.loadFromLocal();" novalidate>

        @csrf

        <div class="space-y-8">
            {{-- Purchase Header Section --}}
            @include('admin.purchases.partials.header-section')

            {{-- Product Items Section --}}
            <div
                class="rounded-lg bg-white dark:bg-gray-800 p-8 border border-gray-200 dark:border-transparent
                text-gray-900 dark:text-gray-100 shadow-none dark:shadow-md dark:shadow-gray-900/50">

                <!-- Section Header -->
                <div class="flex items-center justify-between mb-4 border-b border-gray-200 dark:border-gray-700 pb-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Items Added</h3>

                    <button type="button" id="add-item-btn" tabindex="5" @click="$store.purchaseModal.open()"
                        class="flex items-center gap-2 rounded-md bg-purple-600 px-4 py-2 text-white text-sm
                        hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Item
                    </button>
                </div>

                <!-- Items Table -->
                <div class="overflow-x-auto rounded-lg border border-gray-100 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">#
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Item Code</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Item Name</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Qty
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Net
                                    Wt</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Amount</th>
                                <th class="px-4 py-2 text-right text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700"
                            x-show="$store.purchaseModal.items.length">
                            <template x-for="(item, index) in $store.purchaseModal.items" :key="index">
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-2 text-sm" x-text="index + 1"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.item_code"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.item_name"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.quantity || '-'"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.net_weight"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.total_amount"></td>
                                    <td class="px-4 py-2 text-right">
                                        <button type="button" @click="$store.purchaseModal.removeItem(index)"
                                            class="text-red-500 hover:text-red-700 text-sm font-medium">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>

                        <tbody x-show="!$store.purchaseModal.items.length">
                            <tr>
                                <td colspan="7"
                                    class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 text-sm">
                                    No items added yet. Click “Add Item” to begin.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Subtotal and Submit -->
                <div class="flex justify-between items-center mt-6">
                    <div class="text-gray-700 dark:text-gray-200 text-sm">
                        <span>Total Items:</span>
                        <span x-text="$store.purchaseModal.items.length"></span>
                    </div>

                    <x-primary-button type="submit">
                        Submit Purchase
                    </x-primary-button>
                </div>

                <input type="hidden" name="items_json" :value="JSON.stringify($store.purchaseModal.items)">
            </div>
        </div>

        <!-- Modern Add Item Modal -->
        <div x-show="$store.purchaseModal.show" x-transition.opacity.duration.250ms
            class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-md bg-black/50 dark:bg-black/70"
            @click.self="$store.purchaseModal.close()" @keydown.escape.window="$store.purchaseModal.close()">
            <!-- Modal Panel -->
            <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                class="relative w-[95%] sm:w-11/12 md:w-5/6 lg:w-4/5 xl:max-w-5xl
               bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700
               transform transition-all duration-300 max-h-[90vh] flex flex-col overflow-hidden"
                role="dialog" aria-modal="true" aria-labelledby="modal-title">
                <!-- Sticky Header -->
                <div
                    class="flex-none sticky top-0 z-10 flex items-center justify-between px-6 py-4
                   border-b border-gray-200 dark:border-gray-700 bg-gray-50/90 dark:bg-gray-800/80 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-700/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h2 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            Add New Item
                        </h2>
                    </div>

                    <button type="button" @click="$store.purchaseModal.close()"
                        class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 rounded-full p-2 transition hover:bg-gray-100 dark:hover:bg-gray-800"
                        title="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Scrollable Body -->
                <div class="flex-1 overflow-y-auto px-6 py-8 custom-scrollbar">
                    <form x-ref="itemForm" class="space-y-12" novalidate>
                        {{-- Product Info --}}
                        <section>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-4">
                                Product Details
                            </h3>
                            <div class="space-y-6">
                                @include('admin.purchases.partials.product-section')
                            </div>
                        </section>

                        <div class="border-t border-gray-200 dark:border-gray-700 my-10"></div>

                        {{-- Pricing --}}
                        <section>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-4">
                                Pricing & Charges
                            </h3>
                            <div class="space-y-6">
                                @include('admin.purchases.partials.pricing-section')
                            </div>
                        </section>

                        <div class="border-t border-gray-200 dark:border-gray-700 my-10"></div>

                        {{-- Certification --}}
                        <section>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-4">
                                Certification & Card Details
                            </h3>
                            <div class="space-y-6">
                                @include('admin.purchases.partials.card-details')
                            </div>
                        </section>
                        <div class="flex flex-col items-center mt-6" x-show="item.qr_code">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">QR Code Preview</p>
                            <img :src="item.qr_code" alt="QR Code" class="w-40 h-40 border rounded-lg shadow-md">
                        </div>
                        <input type="hidden" name="qr_code" x-model="item.qr_code">
                    </form>
                </div>



                <!-- Sticky Footer -->
                <div
                    class="flex-none sticky bottom-0 flex flex-col sm:flex-row justify-end gap-3 px-6 py-4
                   border-t border-gray-200 dark:border-gray-700 bg-gray-50/90 dark:bg-gray-800/80 backdrop-blur-sm">
                    <button type="button" @click="$store.purchaseModal.close()"
                        class="rounded-md border border-gray-300 dark:border-gray-600 px-5 py-2 text-sm font-medium
                       text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800
                       transition w-full sm:w-auto flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </button>

                    <!-- ✅ Now directly calls Alpine function -->
                    <button type="button" @click="addItem()"
                        class="rounded-md bg-purple-600 hover:bg-purple-700 px-5 py-2 text-sm font-semibold
                       text-white shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-500
                       transition w-full sm:w-auto flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Add Item
                    </button>
                </div>
            </div>
        </div>

    </form>


    @if (session('clear_items'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (window.Alpine && Alpine.store('purchaseModal')) {
                    Alpine.store('purchaseModal').clearAll?.();
                }
                localStorage.removeItem('purchase_items');
            });
        </script>
    @endif
</x-app-layout>
