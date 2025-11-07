{{-- resources/views/admin/purchases/create.blade.php --}}
<x-app-layout>
    @slot('title', 'Upload Product Purchase Details')

    <!-- Main Purchase Form -->
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" x-data="purchaseForm()"
        x-init="init();
        enableSequentialInput();
        $nextTick(() => focusFirstInput());">

        @csrf

        <div class="space-y-6">

            {{-- Header Section --}}
            @include('admin.purchases.partials.header-section')

            {{-- Items Section --}}
            <div
                class="rounded-lg bg-white dark:bg-gray-800 sm:p-8 text-gray-900 dark:text-gray-100
                border border-gray-200 dark:border-transparent shadow-none dark:shadow-md dark:shadow-gray-900/50">

                <!-- Section Header -->
                <div class="flex items-center justify-between mb-4 border-b border-gray-200 dark:border-gray-700 pb-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Product Items</h3>

                    <button type="button" x-ref="addItemBtn" @click="$store.purchaseModal.open()"
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
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">#
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Item Code</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Item Name</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Gross Wt</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Stone Wt</th>
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
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200" x-text="index + 1">
                                    </td>
                                    <td class="px-4 py-2 text-sm" x-text="item.item_code"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.item_name"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.gross_weight"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.stone_weight"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.net_weight"></td>
                                    <td class="px-4 py-2 text-sm" x-text="item.total_amount"></td>
                                    <td class="px-4 py-2 text-right">
                                        <button type="button" @click="$store.purchaseModal.items.splice(index, 1)"
                                            class="text-red-500 hover:text-red-700 text-sm font-medium">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>

                        <tbody x-show="!$store.purchaseModal.items.length">
                            <tr>
                                <td colspan="8"
                                    class="px-4 py-4 text-center text-gray-500 dark:text-gray-400 text-sm">
                                    No items added yet.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="items_json" :value="JSON.stringify($store.purchaseModal.items)">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="rounded-md bg-green-600 px-6 py-2 text-white text-sm font-medium
           hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Submit Purchase
                </button>
            </div>
        </div>
    </form>

    <!-- Detached Modal -->
    <div x-data x-show="$store.purchaseModal.show" x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-black/70"
        @click.self="$store.purchaseModal.close()" x-init="$watch('$store.purchaseModal.show', (open) => {
            if (open) {
                $nextTick(() => {
                    enableSequentialInput();
                    focusFirstInput();
                });
            }
        })">

        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-7xl shadow-lg max-h-[90vh] overflow-y-auto">
            <form id="itemForm" x-data="itemForm()" @submit.prevent="$store.purchaseModal.addItem"
                class="space-y-6">
                @include('admin.purchases.partials.product-section')
                @include('admin.purchases.partials.pricing-section')
                @include('admin.purchases.partials.card-details')

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" @click="$store.purchaseModal.close()"
                        class="rounded-md border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-700
                        dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit"
                        class="rounded-md bg-purple-600 px-4 py-2 text-sm text-white hover:bg-purple-700
                        focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Add Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
