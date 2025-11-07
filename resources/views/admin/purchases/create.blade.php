<x-app-layout>
    @slot('title', 'Upload Product Purchase Details')

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" x-data="purchaseForm()"
        x-init="init();
        $nextTick(() => focusFirstInput());">

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

                    <button type="button" x-ref="addItemBtn" tabindex="5" @click="$store.purchaseModal.open()"
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
    </form>

    <!-- Modal for Adding Items -->
    <div x-data x-show="$store.purchaseModal.show" x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-black/70"
        @click.self="$store.purchaseModal.close()" x-init="$watch('$store.purchaseModal.show', open => open && $nextTick(() => focusFirstInput()))">

        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-5xl shadow-lg max-h-[90vh] overflow-y-auto">
            <form id="itemForm" x-data="itemForm()" @submit.prevent="addItem" class="space-y-6">

                @include('admin.purchases.partials.product-section')
                @include('admin.purchases.partials.pricing-section')
                @include('admin.purchases.partials.card-details')

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" @click="$store.purchaseModal.close()"
                        class="rounded-md border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm
                    text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Cancel
                    </button>

                    <button type="submit"
                        class="rounded-md bg-purple-600 px-4 py-2 text-sm text-white
                    hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Add Item
                    </button>
                </div>
            </form>
        </div>
    </div>
    @if (session('clear_items'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // ✅ Clear Alpine store items
                if (window.Alpine && Alpine.store('purchaseModal')) {
                    Alpine.store('purchaseModal').clearAll?.();
                }

                // ✅ Also clear localStorage manually (in case store isn’t loaded yet)
                localStorage.removeItem('purchase_items');
            });
        </script>
    @endif
</x-app-layout>
