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
    <?php $__env->slot('title', 'Assign Diamond Certificates'); ?>

        <div class="mx-auto text-gray-900 dark:text-gray-100 bg-white p-6 shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">


            <!-- Assignment Form -->
            <div>
                <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-100">Assign Certificate to Customer
                </h3>

                <form action="<?php echo e(route('merchant.cards.assign')); ?>" method="POST" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <div x-data="{
                        selectedCard: '',
                        valuation: '',
                        
                        price: '',
                        discount: '',
                        get finalPrice() {
                            if (this.price && this.discount) {
                                return (this.price - (this.price * this.discount / 100)).toFixed(2);
                            }
                            return this.price || '';
                        }
                    }" class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <!-- Select Customer -->
                        <div>
                            <label for="customer"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Select Customer
                            </label>
                            <select id="customer" name="customer" required
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 shadow-sm transition duration-200 ease-in-out focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200">
                                <option value="" disabled selected>-- Select Customer --</option>
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Select Card -->
                        <div>
                            <label for="card_id"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Select Card
                            </label>
                            <select id="card_id" name="card_id" required x-model="selectedCard"
                                @change="valuation = cards.find(c => c.id == selectedCard)?.valuation || ''"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 shadow-sm transition duration-200 ease-in-out focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200">
                                <option value="" disabled selected>-- Select Card --</option>
                                
                            </select>
                        </div>

                        <!-- Card Valuation -->
                        <div>
                            <label for="valuation"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Card Valuation
                            </label>
                            <input type="text" id="valuation" name="valuation" x-model="valuation" readonly
                                class="block w-full rounded-lg border border-gray-300 bg-gray-100 px-3 py-2 text-sm text-gray-800 shadow-sm transition duration-200 ease-in-out focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                                placeholder="Auto-fetched from database" />
                        </div>

                        <!-- Selling Price -->
                        <div>
                            <label for="price"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Selling Price
                            </label>
                            <input type="number" step="0.01" id="price" name="price" x-model="price" required
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 shadow-sm transition duration-200 ease-in-out focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                                placeholder="Enter selling price" />
                        </div>

                        <!-- Discount -->
                        <div>
                            <label for="discount"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Discount (%)
                            </label>
                            <input type="number" step="0.1" id="discount" name="discount" x-model="discount"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 shadow-sm transition duration-200 ease-in-out focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200"
                                placeholder="Enter discount percentage" />
                        </div>

                        <!-- Final Price -->
                        <div>
                            <label for="final_price"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Final Price
                            </label>
                            <input type="text" id="final_price" name="final_price" x-bind:value="finalPrice"
                                readonly
                                class="block w-full rounded-lg border border-gray-300 bg-gray-100 px-3 py-2 text-sm text-gray-800 shadow-sm transition duration-200 ease-in-out focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                                placeholder="Auto-calculated" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end md:col-span-2">
                            <button type="submit"
                                class="rounded-lg bg-purple-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                Assign Certificate
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Assigned Certificates Table -->
        <div class="bg-white p-6 shadow dark:bg-gray-800 sm:rounded-lg sm:p-8 mt-4">
            <h3 class="my-4 text-lg font-semibold">Assigned Certificates</h3>
            <div class="w-full overflow-x-auto">
                <table class="whitespace-no-wrap w-full">
                    <thead>
                        <tr
                            class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Certificate ID</th>
                            <th class="px-4 py-3">Diamond Type</th>
                            <th class="px-4 py-3">Carat Weight</th>
                            <th class="px-4 py-3">Assigned On</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y bg-white dark:divide-gray-700 dark:bg-gray-800">
                        
                        <tr class="text-gray-700 dark:text-gray-400">
                            
                            </td>
                        </tr>
                        
                        
                    </tbody>
                </table>
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
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/merchant/cards/assign.blade.php ENDPATH**/ ?>