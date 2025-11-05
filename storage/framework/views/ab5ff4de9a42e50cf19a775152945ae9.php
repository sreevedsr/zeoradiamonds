
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->slot('title', 'Upload Product Purchase Details'); ?>

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Upload Product Purchase Details
    </h2>

    <div class="space-y-6">
        <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8">
            <div class="mx-auto text-gray-900 dark:text-gray-100">

                
                <?php if(session('success')): ?>
                    <div class="mb-4 rounded-md border border-green-300 bg-green-100 p-3 text-green-700">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                
                <?php if($errors->any()): ?>
                    <div class="mb-4 rounded-md border border-red-300 bg-red-100 p-3 text-red-700">
                        <strong class="block mb-1">Please fix the following errors:</strong>
                        <ul class="list-inside list-disc">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                
                <form method="POST" action="<?php echo e(route('admin.products.store')); ?>" enctype="multipart/form-data"
                    x-data="purchaseForm()" x-init="init()">
                    <?php echo csrf_field(); ?>

                    
                    <input type="hidden" x-model="accordion.purchaseOpen"
                        :value="<?php echo e($errors->hasAny([
                            'invoice_no',
                            'supplier',
                            'salesman',
                            'barcode',
                            'product_code',
                            'item_code',
                            'item_name',
                            'quantity',
                            'gold_rate',
                            'gross_weight',
                            'stone_weight',
                            'diamond_weight',
                            'stone_amount',
                            'diamond_price',
                            'making_charge',
                            'card_charge',
                            'other_charge',
                            'landing_cost',
                            'retail_percent',
                            'mrp_percent',
                        ])
                            ? '1'
                            : '0'); ?>" />

                    <input type="hidden" x-model="accordion.cardOpen"
                        :value="<?php echo e($errors->hasAny([
                            'certificate_id',
                            'diamond_purchase_location',
                            'category',
                            'diamond_shape',
                            'carat_weight',
                            'color',
                            'clarity',
                            'cut',
                            'valuation',
                            'certificate_code',
                        ])
                            ? '1'
                            : '0'); ?>" />

                    
                    <div class="space-y-4">

                        
                        <section
                            class="rounded-md border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                            <header class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">Purchase Details
                                    </h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Enter the purchase / stock
                                        details for the product.</p>
                                </div>

                                <button type="button" @click="accordion.purchaseOpen = !accordion.purchaseOpen"
                                    class="rounded-md px-3 py-1 text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                    <span x-show="!accordion.purchaseOpen">Expand</span>
                                    <span x-show="accordion.purchaseOpen">Collapse</span>
                                </button>
                            </header>

                            <div x-show="accordion.purchaseOpen" x-collapse class="mt-4">
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Date
                                            <span class="text-red-500">*</span></label>
                                        <input type="date" name="date"
                                            value="<?php echo e(old('date', now()->toDateString())); ?>" readonly
                                            class="w-full cursor-not-allowed rounded-md border border-gray-300 px-3 py-2 bg-gray-100 text-gray-700 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Auto-filled. Change in
                                            controller if required.</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Supplier
                                            (Name / Code) <span class="text-red-500">*</span></label>
                                        <select name="supplier" x-model="supplier"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                            <option value="">-- Select supplier --</option>
                                            
                                            <?php if(isset($suppliers)): ?>
                                                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($s->id); ?>" <?php if(old('supplier') == $s->id): echo 'selected'; endif; ?>>
                                                        <?php echo e($s->name); ?> / <?php echo e($s->code ?? $s->id); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Choose supplier. Add
                                            suppliers in admin → suppliers.</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Invoice
                                            No. <span class="text-red-500">*</span></label>
                                        <input type="text" name="invoice_no" x-model="invoice_no"
                                            value="<?php echo e(old('invoice_no')); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Supplier invoice
                                            identifier.</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Salesman
                                            <span class="text-red-500">*</span></label>
                                        <select name="salesman" x-model="salesman"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                            <option value="">-- Select salesman --</option>
                                            <?php if(isset($salesmen)): ?>
                                                <?php $__currentLoopData = $salesmen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($sm->id); ?>" <?php if(old('salesman') == $sm->id): echo 'selected'; endif; ?>>
                                                        <?php echo e($sm->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Salesman associated
                                            with the purchase.</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">SI.
                                            No.</label>
                                        <input type="text" name="si_no" x-model="si_no"
                                            value="<?php echo e(old('si_no')); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                    </div>

                                    

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Product
                                            Code</label>
                                        <input type="text" name="product_code" x-model="product_code"
                                            value="<?php echo e(old('product_code')); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Item
                                            Code</label>
                                        <input type="text" name="item_code" x-model="item_code"
                                            value="<?php echo e(old('item_code')); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Item
                                            Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="item_name" x-model="item_name"
                                            value="<?php echo e(old('item_name')); ?>" @input="onItemNameChange"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Item name may be
                                            auto-filled by item code in future. For now you can enter it manually.</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Quantity
                                            <span class="text-red-500">*</span></label>
                                        <input type="number" min="1" step="1" name="quantity"
                                            x-model.number="quantity" value="<?php echo e(old('quantity', 1)); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Number of pieces.</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Gold
                                            Rate (per unit) <span class="text-red-500">*</span></label>
                                        <input type="number" min="0" step="0.01" name="gold_rate"
                                            x-model.number="gold_rate" value="<?php echo e(old('gold_rate', 0)); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Auto value can be
                                            filled from live rates. Editable here.</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Gross
                                            Weight (g) <span class="text-red-500">*</span></label>
                                        <input type="number" min="0" step="0.01" name="gross_weight"
                                            x-model.number="gross_weight" value="<?php echo e(old('gross_weight', 0)); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Stone
                                            Weight (g)</label>
                                        <input type="number" min="0" step="0.001" name="stone_weight"
                                            x-model.number="stone_weight" value="<?php echo e(old('stone_weight', 0)); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Diamond
                                            Weight (g)</label>
                                        <input type="number" min="0" step="0.001" name="diamond_weight"
                                            x-model.number="diamond_weight" value="<?php echo e(old('diamond_weight', 0)); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Net
                                            Weight (g)</label>
                                        <input type="number" readonly :value="net_weight.toFixed(3)"
                                            name="net_weight"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50 text-gray-800 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Calculated as Gross -
                                            Stone - Diamond.</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Stone
                                            Amount</label>
                                        <input type="number" min="0" step="0.01" name="stone_amount"
                                            x-model.number="stone_amount" value="<?php echo e(old('stone_amount', 0)); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Diamond
                                            Price</label>
                                        <input type="number" min="0" step="0.01" name="diamond_price"
                                            x-model.number="diamond_price" value="<?php echo e(old('diamond_price', 0)); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Editable; used in
                                            total calculation.</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Making
                                            Charge</label>
                                        <input type="number" min="0" step="0.01" name="making_charge"
                                            x-model.number="making_charge" value="<?php echo e(old('making_charge', 0)); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Card
                                            Charge</label>
                                        <input type="number" min="0" step="0.01" name="card_charge"
                                            x-model.number="card_charge" value="<?php echo e(old('card_charge', 0)); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Other
                                            Charge</label>
                                        <input type="number" min="0" step="0.01" name="other_charge"
                                            x-model.number="other_charge" value="<?php echo e(old('other_charge', 0)); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                    </div>

                                    
                                    <div class="md:col-span-2">
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Total
                                            Amount (Including Gold Rate)</label>
                                        <input type="text" readonly :value="formatCurrency(total_amount)"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50 text-gray-800 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Calculated live: (Net
                                            weight × Gold Rate) + Stone Amount + Diamond Price + Charges</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Landing
                                            Cost (editable)</label>
                                        <input type="number" min="0" step="0.01" name="landing_cost"
                                            x-model.number="landing_cost" value="<?php echo e(old('landing_cost', 0)); ?>"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Auto suggested: total
                                            amount minus gold component. Editable for manual adjustments.</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Retail
                                            Cost (%)</label>
                                        <div class="flex gap-2">
                                            <input type="number" min="0" step="0.01"
                                                x-model.number="retail_percent" name="retail_percent"
                                                value="<?php echo e(old('retail_percent', 0)); ?>"
                                                class="w-1/2 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                            <input type="text" readonly :value="formatCurrency(retail_cost)"
                                                class="w-1/2 rounded-md border border-gray-300 px-3 py-2 bg-gray-50 text-gray-800 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                        </div>
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Retail = Landing Cost
                                            × (1 + Retail % / 100)</p>
                                    </div>

                                    
                                    <div>
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">MRP
                                            Cost (%)</label>
                                        <div class="flex gap-2">
                                            <input type="number" min="0" step="0.01"
                                                x-model.number="mrp_percent" name="mrp_percent"
                                                value="<?php echo e(old('mrp_percent', 0)); ?>"
                                                class="w-1/2 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                            <input type="text" readonly :value="formatCurrency(mrp_cost)"
                                                class="w-1/2 rounded-md border border-gray-300 px-3 py-2 bg-gray-50 text-gray-800 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100" />
                                        </div>
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">MRP = Landing Cost ×
                                            (1 + MRP % / 100)</p>
                                    </div>

                                    
                                    <div class="md:col-span-2">
                                        <label
                                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Barcode
                                            / QR (placeholders)</label>
                                        <div class="flex flex-wrap gap-2">
                                            <button type="button"
                                                @click="barcode = barcode || 'BC-'+Math.floor(Math.random()*1000000)"
                                                class="rounded-md border px-3 py-2 text-sm">Quick barcode</button>
                                            <button type="button" disabled
                                                class="rounded-md border px-3 py-2 text-sm cursor-not-allowed">Generate
                                                QR (coming soon)</button>
                                        </div>
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Barcode & QR
                                            generation will be integrated later. Buttons here are placeholders and
                                            helpers.</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        
                        <section
                            class="rounded-md border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                            <header class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">Card Details</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Diamond certificate &
                                        card-specific fields.</p>
                                </div>

                                <button type="button" @click="accordion.cardOpen = !accordion.cardOpen"
                                    class="rounded-md px-3 py-1 text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                    <span x-show="!accordion.cardOpen">Expand</span>
                                    <span x-show="accordion.cardOpen">Collapse</span>
                                </button>
                            </header>

                            <div x-show="accordion.cardOpen" x-collapse class="mt-4">
                                <div x-data="{ openDropdown: null }" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                    <!-- Certificate ID -->
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                            Certificate ID
                                            <span class="text-red-500">*</span> </label> <input type="text"
                                            name="certificate_id"
                                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                            placeholder="Enter unique certificate ID" required>
                                    </div>

                                    <!-- Color -->
                                    <div x-data="{ open: false, selectedColor: '' }" class="relative"> <label
                                            class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                            Color <span class="text-red-500">*</span> </label>
                                        <!-- Dropdown trigger --> <button type="button" @click="open = !open"
                                            class="flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                            <span x-text="selectedColor || 'Select diamond color'"
                                                :class="selectedColor ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="ml-2 h-4 w-4 transform transition-transform duration-300 dark:text-gray-100"
                                                :class="open ? 'rotate-180' : 'rotate-0'" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg> </button> <!-- Dropdown options as cards -->
                                        <div x-show="open" @click.outside="open = false"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                            x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                            class="absolute z-10 mt-2 grid w-full grid-cols-7 gap-2 overflow-y-auto rounded-lg border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-700 dark:bg-gray-800">
                                            <?php $__currentLoopData = range('D', 'Z'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div @click="selectedColor = '<?php echo e($color); ?>'; open = false"
                                                    class="cursor-pointer select-none rounded-md border px-3 py-2 text-center text-sm font-medium transition-all duration-200"
                                                    :class="selectedColor === '<?php echo e($color); ?>' ?
                                                        'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-900 dark:text-white shadow-sm' :
                                                        'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200'">
                                                    <?php echo e($color); ?> </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div> <!-- Hidden input for form submission --> <input type="hidden"
                                            name="color" x-model="selectedColor" required>
                                    </div>

                                    <!-- Clarity -->
                                    <div x-data="{ open: false, selectedClarity: '' }" class="relative"> <label
                                            class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                            Clarity <span class="text-red-500">*</span> </label>
                                        <!-- Dropdown trigger --> <button type="button" @click="open = !open"
                                            class="flex w-full cursor-pointer items-center justify-between rounded-md border border-gray-300 px-3 py-2 transition focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                            <span x-text="selectedClarity || 'Select diamond clarity'"
                                                :class="selectedClarity ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
                                            <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': open }"
                                                class="h-5 w-5 transition-transform duration-200" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg> </button> <!-- Dropdown options as cards -->
                                        <div x-show="open" @click.outside="open = false"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                            x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                            class="absolute z-10 mt-2 grid max-h-[140px] w-full grid-cols-2 gap-2 overflow-y-auto rounded-lg border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-700 dark:bg-gray-800 sm:grid-cols-3 lg:grid-cols-5">
                                            <!-- Card options -->
                                            <?php $__currentLoopData = ['FL', 'IF', 'VVS1', 'VVS2', 'VS1', 'VS2', 'SI1', 'SI2', 'SI3', 'I1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clarity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div @click="selectedClarity = '<?php echo e($clarity); ?>'; open = false"
                                                    class="cursor-pointer select-none rounded-md border px-3 py-2 text-center text-sm font-medium transition-all duration-200"
                                                    :class="selectedClarity === '<?php echo e($clarity); ?>' ?
                                                        'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-900 dark:text-white shadow-sm' :
                                                        'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200'">
                                                    <?php echo e($clarity); ?> </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div> <!-- Hidden input for form submission -->
                                        <input type="hidden" name="clarity" x-model="selectedClarity" required>
                                    </div>

                                    <!-- Cut Selection -->
                                    <div x-data="{ open: false, selectedCut: '' }" class="relative"> <label
                                            class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                            Cut <span class="text-red-500">*</span> </label> <!-- Hidden input -->
                                        <input type="hidden" name="cut" x-model="selectedCut" required>
                                        <!-- Dropdown Button --> <button type="button" @click="open = !open"
                                            class="flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                            <span x-text="selectedCut || 'Select Cut'"
                                                :class="selectedCut ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="ml-2 h-4 w-4 transform transition-transform duration-300"
                                                :class="open ? 'rotate-180' : 'rotate-0'" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg> </button> <!-- Dropdown Options -->
                                        <div x-show="open" @click.outside="open = false"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                            x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                            class="absolute z-50 mt-2 grid w-full origin-top grid-cols-2 gap-3 rounded-lg border border-gray-300 bg-white p-3 shadow-lg dark:border-gray-600 dark:bg-gray-800">
                                            <?php $__currentLoopData = ['Poor', 'Fair', 'Good', 'Very Good', 'Excellent', 'Ideal']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div @click="selectedCut = '<?php echo e($cut); ?>'; open = false"
                                                    class="cursor-pointer select-none rounded-md border px-3 py-2 text-center transition-all duration-200"
                                                    :class="selectedCut === '<?php echo e($cut); ?>' ?
                                                        'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-800 dark:text-white shadow-sm' :
                                                        'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200'">
                                                    <?php echo e($cut); ?> </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>

                                    <!-- Diamond Certificate Upload -->
                                    <div x-data="{ preview: null }" class="md:col-span-2"> <label
                                            class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                            Diamond Certificate
                                            Image </label> <label for="diamond_image"
                                            class="group relative flex h-52 w-full cursor-pointer flex-col items-center justify-center overflow-hidden rounded-lg border-2 border-dashed border-gray-400 bg-transparent px-6 py-8 transition-all hover:border-purple-500 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <!-- File Input --> <input id="diamond_image" name="diamond_image"
                                                type="file" accept="image/*"
                                                class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
                                                @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                                            <!-- Upload Icon & Text (Hidden when preview exists) -->
                                            <div x-show="!preview"
                                                class="flex flex-col items-center justify-center space-y-2 text-center transition-opacity">
                                                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                                                    class="h-10 w-10 text-gray-400 transition-colors group-hover:text-purple-500 dark:text-gray-500">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" />
                                                </svg>
                                                <p class="text-sm font-semibold text-purple-600 dark:text-purple-400">
                                                    Upload Certificate
                                                    Image</p>
                                                <p class="text-xs text-gray-400 dark:text-gray-500">PNG, JPG up to 10MB
                                                </p>
                                            </div> <!-- Preview Image (Shown when uploaded) -->
                                            <div x-show="preview" class="flex flex-col items-center p-3"> <img
                                                    :src="preview" alt="Preview"
                                                    class="h-24 w-24 rounded-md border border-gray-300 bg-white object-cover p-1 shadow-md dark:border-gray-600 dark:bg-gray-700">
                                                <button type="button" @click="preview = null"
                                                    class="text-m mt-4 rounded-md px-3 py-1.5 font-medium transition-all duration-200 hover:text-white">
                                                    Remove </button>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>

                    
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="rounded-md bg-purple-600 px-6 py-2 text-white transition duration-150 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            Save Product
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/admin/cards/create.blade.php ENDPATH**/ ?>