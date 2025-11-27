<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'headers' => [],
    'collection' => null,
    'searchPlaceholder' => 'Search...',
    'searchQuery' => request('search', ''),
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
    'collection' => null,
    'searchPlaceholder' => 'Search...',
    'searchQuery' => request('search', ''),
    'route' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="w-full overflow-hidden rounded-lg bg-white dark:bg-gray-800 p-4 md:p-7 md:pb-4">

    <form method="GET" action="<?php echo e($route ?? url()->current()); ?>"
        class="flex flex-col space-y-3 border-b dark:border-gray-700 md:flex-row md:items-end md:justify-start md:space-y-0 md:gap-6 pb-4"
        x-data="{
            query: '<?php echo e($searchQuery); ?>',
            timeout: null,
            search() {
                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => {
                    $refs.searchInput.value = this.query;
                    this.$root.submit();
                }, 300);
            }
        }">


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

            <!-- 🔍 Search -->
            <div class="lg:col-span-1">
                <label for="search-input" class="block text-sm text-gray-600 dark:text-gray-300 mb-1">
                    Search
                </label>

                <div class="flex items-center border rounded-lg px-3 dark:border-gray-700 dark:bg-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-300"
                        fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 7.5-7.5 7.508 7.508 0 0 1-7.5 7.5z" />
                    </svg>

                    <input x-model="query" @input="search" type="text" name="search"
                        placeholder="<?php echo e($searchPlaceholder); ?>"
                        class="w-full bg-transparent pl-3 py-2 focus:ring-0 border-none focus:outline-none
                       dark:text-gray-200" />
                </div>
            </div>

            <!-- ⭐ Filters -->
            <div class="lg:col-span-2 flex flex-wrap gap-3 items-end">
                <?php echo e($filters ?? ''); ?>

            </div>

        </div>



    </form>

    <!-- 📊 DATA TABLE -->
    <div class="relative rounded-lg ">
        <div class="max-h-[68vh] overflow-auto custom-scrollbar">
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
    </div>

    <?php if($collection instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
        <?php echo e($collection->withQueryString()->links('components.pagination')); ?>

    <?php endif; ?>

</div>
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/components/table.blade.php ENDPATH**/ ?>