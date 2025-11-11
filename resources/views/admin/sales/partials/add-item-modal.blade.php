<!-- resources/views/admin/sales/partials/add-item-modal.blade.php -->
<div x-data x-show="$store.purchaseModal.show" x-transition.opacity.duration.200ms
    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/40 dark:bg-black/60"
    @click.self="$store.purchaseModal.close()" @keydown.escape.window="$store.purchaseModal.close()"
    x-init="$watch('$store.purchaseModal.show', open => {
        if (open) {
            $nextTick(() => {
                // Initialize modal subform behavior
                enableSequentialInput($refs.saleForm);
                focusFirstInput($refs.saleForm);
                // populate merchant state on open
                saleItemForm().syncMerchantState();
            });
        }
    });">

    <!-- Modal Panel -->
    <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-3"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="relative w-full max-w-4xl bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden"
        role="dialog" aria-modal="true" aria-labelledby="sale-modal-title">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 id="sale-modal-title"
                class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Sale Item
            </h2>

            <button type="button" @click="$store.purchaseModal.close()"
                class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none rounded-full p-1.5 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="saleItemForm"
      x-ref="saleForm"
      x-data="saleItemForm()"
      @submit.prevent="addItem"
      class="px-6 py-5 space-y-6 overflow-y-auto max-h-[70vh] custom-scrollbar
             bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg shadow-sm transition-colors">

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

        <x-input.text label="SI. No." model="si_no" readonly />

        <x-input.text label="Barcode" model="barcode" placeholder="Scan or type barcode" />

        <x-input.text label="Product Code" model="product_code" placeholder="Product Code" />

        <x-input.text label="Item Code" model="item_code" readonly />

        <x-input.text label="Item Name" model="item_name" readonly />

        <x-input.text label="HSN Code" model="hsn" required />

        <x-input.text label="Quantity" type="number" model="quantity"
                      step="1" @input="recomputeAll" />

        <x-input.text label="Gross Weight (g)" type="number" model="gross_weight"
                      step="0.001" @input="recomputeAll" />

        <x-input.text label="Stone Weight (g)" type="number" model="stone_weight"
                      step="0.001" @input="recomputeAll" />

        <x-input.text label="Diamond Weight (g)" type="number" model="diamond_weight"
                      step="0.001" @input="recomputeAll" />

        <x-input.text label="Net Weight (g)" type="number" model="net_weight" readonly />

        <x-input.text label="Net Amount (₹)" type="number" model="net_amount"
                      step="0.01" @input="recomputeTaxes" />

        <!-- Taxes -->
        <div class="col-span-1 sm:col-span-2 lg:col-span-3 mt-2 grid gap-3">
            <template x-if="intraState">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 w-full">
                    <div class="p-3 rounded border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                        <div class="text-xs text-gray-500 dark:text-gray-400">CGST (1.5%)</div>
                        <div class="font-medium" x-text="formatMoney(cgst_amount)"></div>
                    </div>
                    <div class="p-3 rounded border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                        <div class="text-xs text-gray-500 dark:text-gray-400">SGST (1.5%)</div>
                        <div class="font-medium" x-text="formatMoney(sgst_amount)"></div>
                    </div>
                </div>
            </template>

            <template x-if="!intraState">
                <div class="p-3 rounded border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 w-full">
                    <div class="text-xs text-gray-500 dark:text-gray-400">IGST (3%)</div>
                    <div class="font-medium" x-text="formatMoney(igst_amount)"></div>
                </div>
            </template>
        </div>

        <x-input.text label="Total Amount (₹)" model="total_amount_display" readonly />
    </div>

    <!-- Footer -->
    <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <button type="button" @click="$store.purchaseModal.close()"
                class="rounded-md border border-gray-300 dark:border-gray-600
                       px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200
                       hover:bg-gray-100 dark:hover:bg-gray-800 transition">
            Cancel
        </button>

        <button type="submit"
                class="rounded-md bg-purple-600 px-4 py-2 text-sm font-medium text-white
                       hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500
                       shadow-sm transition">
            Add Item
        </button>
    </div>
</form>

    </div>
</div>

<!-- Alpine component script: saleItemForm -->
<script>
    function saleItemForm() {
        return {
            // fields
            si_no: '', // you can set logic to auto-increment
            barcode: '',
            product_code: '',
            item_code: '',
            item_name: '',
            hsn: '',
            quantity: 1,
            gross_weight: 0,
            stone_weight: 0,
            diamond_weight: 0,
            net_weight: 0,
            net_amount: 0,

            // computed tax fields
            cgst_amount: 0,
            sgst_amount: 0,
            igst_amount: 0,

            intraState: true,
            merchant_state_code: '',

            // totals
            total_amount_display: '0.00',

            // merchant / company state used to decide tax split
            merchant_state: '',
            company_state: @json($companyState ?? (config('app.company_state') ?? '')),

            init() {
                // optional: try to derive si_no here (e.g., length+1)
                const items = (Alpine.store('purchaseModal') && Array.isArray(Alpine.store('purchaseModal').items)) ?
                    Alpine.store('purchaseModal').items : [];
                this.si_no = items.length ? String(items.length + 1) : '';
            },

            // call when modal opens to sync merchant state from merchant select
            syncMerchantState() {
                try {
                    const sel = document.querySelector('select[name="merchant_id"]');
                    if (sel) {
                        const opt = sel.options[sel.selectedIndex];
                        this.merchant_state = opt ? (opt.dataset?.state || '') : '';
                    }
                    this.recomputeAll();
                } catch (e) {
                    // no-op
                }
            },

            // when barcode/product_code changes you might want to auto-fill item_code/item_name from server.
            // simple placeholder: attemptLookup can be wired to a fetch if you want.
            attemptLookup() {
                // Example: if barcode filled, you can call an endpoint to fetch item details (not implemented here)
                // fetch(`/admin/products/lookup?barcode=${this.barcode}`).then(...)
            },

            recomputeAll() {
                // net_weight = gross - stone - diamond
                const net = (parseFloat(this.gross_weight) || 0) - (parseFloat(this.stone_weight) || 0) - (parseFloat(
                    this.diamond_weight) || 0);
                this.net_weight = net < 0 ? 0 : parseFloat(net.toFixed(3));

                // recompute taxes based on net_amount
                this.recomputeTaxes();
            },

            recomputeTaxes() {
                const netAmt = parseFloat(this.net_amount) || 0;

                // ✅ Determine whether intra-state (Karnataka: state_code '29')
                this.intraState = String(this.merchant_state_code || '').trim() === '29';

                if (this.intraState) {
                    // CGST + SGST
                    this.cgst_amount = +(netAmt * 0.015).toFixed(2);
                    this.sgst_amount = +(netAmt * 0.015).toFixed(2);
                    this.igst_amount = 0;
                } else {
                    // IGST
                    this.igst_amount = +(netAmt * 0.03).toFixed(2);
                    this.cgst_amount = 0;
                    this.sgst_amount = 0;
                }

                const total = netAmt + this.cgst_amount + this.sgst_amount + this.igst_amount;
                this.total_amount_display = total ? total.toFixed(2) : '0.00';
            },


            // helper to format numbers
            formatMoney(value) {
                const v = parseFloat(value) || 0;
                return v.toFixed(2);
            },

            validate() {
                if (!this.hsn || this.hsn.trim() === '') {
                    alert('HSN Code is required.');
                    return false;
                }
                if (!this.quantity || this.quantity <= 0) {
                    alert('Quantity must be greater than zero.');
                    return false;
                }
                return true;
            },

            addItem() {
                if (!this.validate()) return;

                // ensure merchant_state is fresh
                this.syncMerchantState();
                this.recomputeTaxes();

                // Build item payload that matches items table expectations
                const item = {
                    si_no: this.si_no || '',
                    barcode: this.barcode || '',
                    product_code: this.product_code || '',
                    item_code: this.item_code || '',
                    item_name: this.item_name || '',
                    hsn: this.hsn || '',
                    quantity: this.quantity || 0,
                    gross_weight: this.gross_weight || 0,
                    stone_weight: this.stone_weight || 0,
                    diamond_weight: this.diamond_weight || 0,
                    net_weight: this.net_weight || 0,
                    net_amount: parseFloat(this.net_amount) || 0,
                    cgst_amount: this.cgst_amount || 0,
                    sgst_amount: this.sgst_amount || 0,
                    igst_amount: this.igst_amount || 0,
                    total_amount: parseFloat((parseFloat(this.total_amount_display) || 0)).toFixed(2)
                };

                // Push into the shared purchaseModal items array
                if (Alpine.store('purchaseModal') && Array.isArray(Alpine.store('purchaseModal').items)) {
                    Alpine.store('purchaseModal').items.push(item);
                } else {
                    // fallback: create store if not exists
                    Alpine.store('purchaseModal', {
                        show: false,
                        items: [item],
                        open() {
                            this.show = true
                        },
                        close() {
                            this.show = false
                        }
                    });
                }

                // close modal
                this.resetForm();
                $store.purchaseModal.close();
            },

            resetForm() {
                this.barcode = '';
                this.product_code = '';
                this.item_code = '';
                this.item_name = '';
                this.hsn = '';
                this.quantity = 1;
                this.gross_weight = 0;
                this.stone_weight = 0;
                this.diamond_weight = 0;
                this.net_weight = 0;
                this.net_amount = 0;
                this.cgst_amount = 0;
                this.sgst_amount = 0;
                this.igst_amount = 0;
                this.total_amount_display = '0.00';

                // re-init si_no to next index
                const items = (Alpine.store('purchaseModal') && Array.isArray(Alpine.store('purchaseModal').items)) ?
                    Alpine.store('purchaseModal').items : [];
                this.si_no = items.length ? String(items.length + 1) : '';
            }
        }
    }

    // expose helper for external calls (used in x-init above)
    function saleItemFormInstance() {
        // if Alpine data exists, return an instance; otherwise return the function
        return window.saleItemForm || saleItemForm;
    }
</script>
