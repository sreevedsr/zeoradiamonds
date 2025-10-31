<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'headers' => [],
    'rows' => [],
    'from' => null,
    'to' => null,
    'total' => null,
    'pages' => [],
    'current' => 1,
    'filters' => [],
    'searchPlaceholder' => 'Search...',
    'searchQuery' => request('search', ''),
    'selectedFilter' => request('filter', ''),
    'route' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'headers' => [],
    'rows' => [],
    'from' => null,
    'to' => null,
    'total' => null,
    'pages' => [],
    'current' => 1,
    'filters' => [],
    'searchPlaceholder' => 'Search...',
    'searchQuery' => request('search', ''),
    'selectedFilter' => request('filter', ''),
    'route' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="w-full overflow-hidden rounded-lg bg-white dark:bg-gray-800">
    <!-- Search & Filter Bar -->
    <div x-data="{
        query: '<?php echo e($searchQuery); ?>',
        results: [],
        timeout: null,
        async search() {
            clearTimeout(this.timeout);
            this.timeout = setTimeout(async () => {
                const response = await fetch('<?php echo e($route ?? url()->current()); ?>?search=' + encodeURIComponent(this.query));
                const html = await response.text();

                // Extract the table or main content (optional customization)
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTable = doc.querySelector('#data-table'); // use your actual table wrapper ID

                if (newTable) {
                    document.querySelector('#data-table').innerHTML = newTable.innerHTML;
                }
            }, 300); // debounce 300ms
        }
    }"
        class="flex flex-col justify-between space-y-3 border-b dark:border-gray-700 md:flex-row md:items-center md:space-y-0">

        <div class="flex w-full flex-col gap-3 md:flex-row md:items-center">
            <!-- Search box -->
            <div
                class="flex flex-col justify-between space-y-3 p-4 dark:border-gray-700 md:flex-row md:items-center md:space-y-0">
                <div class="relative flex-grow">
                    <input id="search-input" x-model="query" @input="search" type="text"
                        placeholder="<?php echo e($searchPlaceholder); ?>"
                        class="w-full rounded-lg border px-4 py-2 text-sm focus:ring-2 focus:ring-purple-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200" />
                    <button type="button"
                        class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-500 hover:text-purple-700 dark:text-gray-300 dark:hover:text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 7.5-7.5 7.508 7.508 0 0 1-7.5 7.5z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Filter dropdown (optional) -->
            <?php if($filters): ?>
                <select name="filter"
                    onchange="window.location='<?php echo e($route ?? url()->current()); ?>?filter=' + this.value"
                    class="rounded-lg border px-4 py-2 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
                    <option value="">All</option>
                    <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e($selectedFilter == $key ? 'selected' : ''); ?>>
                            <?php echo e($label); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            <?php endif; ?>
        </div>
    </div>

    <!-- Data Table -->
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-nowrap text-left">
            <thead>
                <tr
                    class="border-b bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                    <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th class="px-4 py-3"><?php echo e($header); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </thead>

            <tbody class="divide-y bg-white dark:divide-gray-700 dark:bg-gray-800">
                <?php echo e($slot); ?>

            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php echo $__env->make('components.pagination', [
        'from' => $from,
        'to' => $to,
        'total' => $total,
        'pages' => $pages,
        'current' => $current,
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('search-input');
        const tableBody = document.querySelector('tbody');
        let timer;

        searchInput.addEventListener('input', function() {
            clearTimeout(timer);
            timer = setTimeout(() => {
                const query = this.value.trim();
                const url = "<?php echo e($route ?? url()->current()); ?>" + "?search=" +
                    encodeURIComponent(query);

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        // Parse the new table body only from response
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newBody = doc.querySelector('tbody');
                        if (newBody) tableBody.innerHTML = newBody.innerHTML;
                    })
                    .catch(err => console.error('Live search error:', err));
            }, 300); // delay 300ms for smoother typing
        });
    });
</script>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/components/table.blade.php ENDPATH**/ ?>