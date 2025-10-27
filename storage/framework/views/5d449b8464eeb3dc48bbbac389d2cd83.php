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
    <?php $__env->slot('title', 'Zeeyame - Dashboard'); ?>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Dashboard
    </h2>

    <?php
        // helpers to format INR
        function money_inr($n)
        {
            return '₹' . number_format($n, 0, '.', ',');
        }

        // arrow helper
        function arrow_badge($num)
        {
            if ($num === null) {
                return '<span class="text-sm text-gray-500">N/A</span>';
            }
            if ($num > 0) {
                return '<span class="text-sm text-green-600">↑ ' . round($num, 2) . '%</span>';
            }
            if ($num < 0) {
                return '<span class="text-sm text-red-600">↓ ' . abs(round($num, 2)) . '%</span>';
            }
            return '<span class="text-sm text-gray-600">0%</span>';
        }
    ?>

    <!-- Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <?php echo $__env->make('dashboard.partials.card', [
            'title' => 'Total Clients',
            'value' => $metrics['total_clients'],
            'color' => 'orange',
            'icon' =>
                'M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z',
            'meta' => 'New this month: ' . $metrics['new_customers_this_month'],
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('dashboard.partials.card', [
            'title' => 'Sales This Month',
            'value' => money_inr($metrics['sales_this_month']),
            'color' => 'green',
            'icon' =>
                'M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z',
            'meta' => 'Last month: ' . money_inr($metrics['sales_last_month']),
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('dashboard.partials.card', [
            'title' => 'Sales Change',
            'value' => money_inr($metrics['sales_diff']),
            'color' => $metrics['sales_diff'] >= 0 ? 'blue' : 'red',
            'icon' => 'M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z',
            'meta' => arrow_badge($metrics['sales_diff_percent']),
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('dashboard.partials.card', [
            'title' => 'New Customers (This Month)',
            'value' => $metrics['new_customers_this_month'],
            'color' => 'teal',
'icon' => 'M11.3 11.5a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9zm7.3 9.5a7.5 7.5 0 1 0-15 0',
            'meta' => arrow_badge($metrics['new_customers_diff_percent']),
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Content Row: Chart + Top customers table -->
    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <!-- Monthly Sales Chart -->
        <div class="p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-200">Monthly Sales (last 6 months)</h3>
            <canvas id="salesChart" width="400" height="200"></canvas>
            <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">Values displayed in INR</p>
        </div>

        <!-- Top customers -->
        <div class="p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-200">Top Customers</h3>
            <div class="overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase">
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Orders</th>
                            <th class="px-4 py-3">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php $__currentLoopData = $metrics['top_customers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="text-gray-700 dark:text-gray-200">
                                <td class="px-4 py-3 text-sm"><?php echo e($c['name']); ?></td>
                                <td class="px-4 py-3 text-sm"><?php echo e($c['orders']); ?></td>
                                <td class="px-4 py-3 text-sm"><?php echo e(money_inr($c['amount'])); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Small summary row -->
    <div class="grid gap-6 mb-8 md:grid-cols-3">
        <div class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <p class="text-sm text-gray-600 dark:text-gray-400">Scope</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo e(ucfirst($scope)); ?> view</p>
        </div>

        <div class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <p class="text-sm text-gray-600 dark:text-gray-400">Sales This Month</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <?php echo e(money_inr($metrics['sales_this_month'])); ?></p>
        </div>

        <div class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <p class="text-sm text-gray-600 dark:text-gray-400">New Customers (This Month)</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo e($metrics['new_customers_this_month']); ?>

            </p>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom chart configuration -->
    <script src="<?php echo e(asset('assets/js/charts-lines.js')); ?>"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const labels = <?php echo json_encode(array_column($metrics['monthly_sales'], 'label'), 512) ?>;
            const values = <?php echo json_encode(array_column($metrics['monthly_sales'], 'value'), 512) ?>;

            // Call function from charts-lines.js
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