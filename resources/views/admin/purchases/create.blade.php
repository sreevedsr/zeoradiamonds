{{-- resources/views/admin/purchases/create.blade.php --}}
<x-app-layout>
    @slot('title', 'Upload Product Purchase Details')

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Upload Product Purchase Details
    </h2>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-4 rounded-md border border-green-300 bg-green-100 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Errors summary --}}
    @if ($errors->any())
        <div class="mb-4 rounded-md border border-red-300 bg-red-100 p-3 text-red-700">
            <strong class="block mb-1">Please fix the following errors:</strong>
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" x-data="purchaseForm()"
        x-init="init();
        enableSequentialInput();
        $nextTick(() => focusFirstInput());">
        @csrf

        <div class="space-y-6">
            {{-- Header Section Fields --}}
            <div
                class="rounded-lg bg-white p-6 dark:bg-gray-800 sm:p-8 text-gray-900 dark:text-gray-100
           border border-gray-200 dark:border-transparent shadow-none dark:shadow-md dark:shadow-gray-900/50">
                <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 ">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Invoice No. <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="invoice_no" x-model="invoice_no" value="{{ old('invoice_no') }}"
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="date" value="{{ old('date', now()->toDateString()) }}" readonly
                            class="input-field w-full cursor-not-allowed rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-gray-700 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Supplier (Name / Code) <span class="text-red-500">*</span>
                        </label>
                        <select name="supplier" x-model="supplier"
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                            <option value="">-- Select supplier --</option>
                            @foreach ($suppliers ?? [] as $s)
                                <option value="{{ $s->id }}" @selected(old('supplier') == $s->id)>
                                    {{ $s->name }} / {{ $s->code ?? $s->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Salesman <span class="text-red-500">*</span>
                        </label>
                        <select name="salesman" x-model="salesman"
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                            <option value="">-- Select salesman --</option>
                            @foreach ($salesmen ?? [] as $sm)
                                <option value="{{ $sm->id }}" @selected(old('salesman') == $sm->id)>
                                    {{ $sm->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div x-data="{
                showModal: false,
                items: [],
                addItem() {
                    // Serialize the modal form inputs into an object
                    const form = document.getElementById('itemForm');
                    const formData = new FormData(form);
                    const item = Object.fromEntries(formData.entries());
                    this.items.push(item);
                    form.reset();
                    this.showModal = false;
                },
                removeItem(index) {
                    this.items.splice(index, 1);
                }
            }"
                x-effect="if (showModal) { $nextTick(() => { init(); enableSequentialInput(); focusFirstInput(); }); }"
                class="rounded-lg bg-white dark:bg-gray-800 sm:p-8 text-gray-900 dark:text-gray-100
           border border-gray-200 dark:border-transparent shadow-none dark:shadow-md dark:shadow-gray-900/50">

                <!-- Header -->
                <div class="flex items-center justify-between mb-4 border-b border-gray-200 dark:border-gray-700 pb-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Product Items</h3>

                    <button @click="showModal = true"
                        class="flex items-center gap-2 rounded-md bg-purple-600 px-4 py-2 text-white text-sm
                   hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Item
                    </button>
                </div>

                <!-- Table -->
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
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700" x-show="items.length">
                            <template x-for="(item, index) in items" :key="index">
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200" x-text="index + 1">
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200"
                                        x-text="item.item_code"></td>
                                    <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200"
                                        x-text="item.item_name"></td>
                                    <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200"
                                        x-text="item.gross_weight"></td>
                                    <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200"
                                        x-text="item.stone_weight"></td>
                                    <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200"
                                        x-text="item.net_weight"></td>
                                    <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200" x-text="item.amount">
                                    </td>
                                    <td class="px-4 py-2 text-right">
                                        <button @click="removeItem(index)"
                                            class="text-red-500 hover:text-red-700 text-sm font-medium">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                        <tbody x-show="!items.length">
                            <tr>
                                <td colspan="8"
                                    class="px-4 py-4 text-center text-gray-500 dark:text-gray-400 text-sm">
                                    No items added yet.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Hidden JSON input for backend -->
                <input type="hidden" name="items_json" :value="JSON.stringify(items)">

                <!-- Modal -->
                <div x-show="showModal" x-transition
                    x-effect="if (showModal) {
        $nextTick(() => {
            const firstInput = $refs.modal.querySelector('input, select, textarea');
            if (firstInput) firstInput.focus();
        });
    }"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-black/70"
                    @click.self="showModal = false" x-ref="modal">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-7xl shadow-lg max-h-[90vh] overflow-y-auto">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Add New Item</h3>
                            <button @click="showModal = false"
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                ✕
                            </button>
                        </div>

                        <form id="itemForm" @submit.prevent="addItem" class="space-y-6">
                            {{-- Product Section --}}
                            @include('admin.purchases.partials.product-section')

                            {{-- Pricing Section --}}
                            @include('admin.purchases.partials.pricing-section')

                            {{-- Card Details Section --}}
                            @include('admin.purchases.partials.card-details')

                            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <button type="button" @click="showModal = false"
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

            </div>

    </form>
</x-app-layout>
