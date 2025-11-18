<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'headers' => [],
    'collection' => null, // Laravel paginator instance
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
    'collection' => null, // Laravel paginator instance
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

<div class="w-full overflow-hidden rounded-t-lg rounded-b-none bg-white dark:bg-gray-800">
    <div x-data="{
        query: '<?php echo e($searchQuery); ?>',
        timeout: null,
        async search() {
            clearTimeout(this.timeout);
            this.timeout = setTimeout(async () => {
                const url = '<?php echo e($route ?? url()->current()); ?>?search=' + encodeURIComponent(this.query);
                const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                const html = await response.text();

                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTable = doc.querySelector('#data-table');
                if (newTable) document.querySelector('#data-table').innerHTML = newTable.innerHTML;
            }, 300);
        }
    }"
        class="flex flex-col justify-between space-y-3 border-b dark:border-gray-700 md:flex-row md:items-center md:space-y-0">
        <div class="flex w-full flex-col gap-3 md:flex-row md:items-center p-4">
            <!-- Search box -->
            <div class="relative">
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

            <!-- Filter dropdown -->
            <?php if(!empty($filters)): ?>
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

    <!-- 🧾 Data Table -->
    <div id="data-table" class="relative max-h-[70vh] overflow-auto rounded-lg custom-scrollbar">
        <table class="min-w-full whitespace-nowrap text-left border-collapse">
            <thead class="sticky top-0 z-10 bg-gray-50 dark:bg-gray-800">
                <tr
                    class="border-b text-xs font-semibold uppercase tracking-wide text-gray-500 dark:border-gray-700 dark:text-gray-400">
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

    <!-- 📄 Pagination -->
    <?php if($collection instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
        <?php echo $__env->make('components.pagination', [
            'from' => $collection->firstItem(),
            'to' => $collection->lastItem(),
            'total' => $collection->total(),
            'pages' => range(1, $collection->lastPage()),
            'current' => $collection->currentPage(),
            'nextPageUrl' => $collection->nextPageUrl(),
            'prevPageUrl' => $collection->previousPageUrl(),
            'route' => $route,
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('search-input');
        const tableBody = document.querySelector('#data-table tbody');
        let timer;

        searchInput?.addEventListener('input', function() {
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
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newBody = doc.querySelector('#data-table tbody');
                        if (newBody) tableBody.innerHTML = newBody.innerHTML;
                    })
                    .catch(err => console.error('Live search error:', err));
            }, 300);
        });
    });
</script>
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/components/table.blade.php ENDPATH**/ ?>