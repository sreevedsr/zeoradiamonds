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
    <?php $__env->slot('title', 'Dashboard'); ?>

    <?php
        function money_inr($n)
        {
            return '₹' . number_format($n, 0, '.', ',');
        }

        function arrow_badge($num)
        {
            if ($num === null) {
                return '<span class="text-xs text-gray-500">N/A</span>';
            }
            if ($num > 0) {
                return '<span class="text-xs text-green-600 font-medium">▲ ' . round($num, 2) . '%</span>';
            }
            if ($num < 0) {
                return '<span class="text-xs text-red-600 font-medium">▼ ' . abs(round($num, 2)) . '%</span>';
            }
            return '<span class="text-xs text-gray-600 font-medium">0%</span>';
        }
    ?>

    <!-- Main Wrapper -->
    <div class="space-y-10">

        <!-- KPI Cards -->
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">

            <!-- Total Merchants / Customers -->
            <div
                class="p-6 rounded-2xl shadow-md bg-white dark:bg-gray-800  hover:shadow-xl hover:scale-[1.02] transition-all">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Total <?php echo e($metrics['entity_title']); ?>

                    </p>
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-500 to-yellow-500 flex items-center justify-center shadow">
                        <span class="text-white font-bold text-lg">#</span>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    <?php echo e($metrics['total_entities']); ?>

                </p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    New this month: <?php echo e($metrics['new_entities_this_month']); ?>

                </p>
            </div>

            <!-- Sales This Month -->
            <div
                class="p-6 rounded-2xl shadow-md bg-white dark:bg-gray-800  hover:shadow-xl hover:scale-[1.02] transition-all">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Sales This Month</p>
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center shadow">
                        <span class="text-white font-bold text-lg">₹</span>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    <?php echo e(money_inr($metrics['sales_this_month'])); ?>

                </p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Last month: <?php echo e(money_inr($metrics['sales_last_month'])); ?>

                </p>
            </div>

            <!-- Sales Change -->
            <div
                class="p-6 rounded-2xl shadow-md bg-white dark:bg-gray-800  hover:shadow-xl hover:scale-[1.02] transition-all">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Sales Change</p>
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br <?php echo e($metrics['sales_diff'] >= 0 ? 'from-blue-500 to-indigo-500' : 'from-red-500 to-rose-500'); ?> flex items-center justify-center shadow">
                        <span class="text-white font-bold text-lg">%</span>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    <?php echo e(money_inr($metrics['sales_diff'])); ?>

                </p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    <?php echo arrow_badge($metrics['sales_diff_percent']); ?>

                </p>
            </div>

            <!-- New Customers / New Merchants -->
            <div
                class="p-6 rounded-2xl shadow-md bg-white dark:bg-gray-800   hover:shadow-xl hover:scale-[1.02] transition-all">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        New <?php echo e($metrics['entity_title']); ?> (This Month)
                    </p>
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center shadow">
                        <span class="text-white font-bold text-lg">+</span>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    <?php echo e($metrics['new_entities_this_month']); ?>

                </p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    <?php echo arrow_badge($metrics['new_entities_diff_percent']); ?>

                </p>
            </div>

        </div>

        <!-- Chart + Top Table -->
        <div class="grid gap-8 md:grid-cols-2">

            <!-- Sales Chart -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3">
                    Monthly Sales (Last 6 Months)
                </h3>

                <div class="w-full">
                    <div class="relative" style="height: 300px;">
                        <canvas id="salesChart" class="w-full h-full"></canvas>
                    </div>
                </div>
            </div>


            <!-- Top Entities (Merchants or Customers) -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl   shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3">
                    Top <?php echo e($metrics['entity_title']); ?>

                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr class="text-xs uppercase text-gray-500 dark:text-gray-300">
                                <th class="px-4 py-3"><?php echo e($metrics['entity_title']); ?></th>
                                <th class="px-4 py-3">Orders</th>
                                <th class="px-4 py-3">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php $__empty_1 = true; $__currentLoopData = $metrics['top_entities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3 text-sm"><?php echo e($row['name']); ?></td>
                                    <td class="px-4 py-3 text-sm"><?php echo e($row['orders']); ?></td>
                                    <td class="px-4 py-3 text-sm"><?php echo e(money_inr($row['amount'])); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">No
                                        data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


        <!-- Summary Row -->
        <div class="grid gap-6 md:grid-cols-3">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl   shadow">
                <p class="text-sm text-gray-600 dark:text-gray-400">Scope</p>
                <p class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                    <?php echo e(ucfirst($metrics['scope'])); ?> view
                </p>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl   shadow">
                <p class="text-sm text-gray-600 dark:text-gray-400">Sales This Month</p>
                <p class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                    <?php echo e(money_inr($metrics['sales_this_month'])); ?>

                </p>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl   shadow">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    New <?php echo e($metrics['entity_title']); ?> This Month
                </p>
                <p class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                    <?php echo e($metrics['new_entities_this_month']); ?>

                </p>
            </div>
        </div>

    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo e(asset('assets/js/charts-lines.js')); ?>"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            <?php
                $monthly = $metrics['monthly_sales']->toArray();
            ?>

            const labels = <?php echo json_encode(array_column($monthly, 'label'), 512) ?>;
            const values = <?php echo json_encode(array_column($monthly, 'value'), 512) ?>;

            if (typeof initSalesChart === 'function') {
                initSalesChart('salesChart', labels, values);
            }
        });
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
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/dashboard/main.blade.php ENDPATH**/ ?>