<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['paginator']));

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

foreach (array_filter((['paginator']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($paginator->hasPages()): ?>
<div
    class=" py-3 text-xs font-semibold tracking-wide text-gray-600 uppercase
           dark:text-gray-300 select-none">

    <div class="grid grid-cols-3 items-center">

        
        <span class="flex items-center">
            Showing <?php echo e($paginator->firstItem()); ?>–<?php echo e($paginator->lastItem()); ?> of <?php echo e($paginator->total()); ?>

        </span>

        <span></span>

        
        <div class="flex justify-end">
            <nav aria-label="Pagination">
                <ul class="flex items-center gap-1">

                    
                    <?php if($paginator->previousPageUrl()): ?>
                        <li>
                            <a href="<?php echo e($paginator->previousPageUrl()); ?>"
                               class="flex items-center justify-center w-9 h-9 rounded-xl
                                      bg-gray-200 dark:bg-gray-700
                                      hover:bg-gray-300 dark:hover:bg-gray-600
                                      transition-all">
                                <svg class="w-4 h-4 text-gray-700 dark:text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" />
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>


                    
                    <?php
                        $current = $paginator->currentPage();
                        $last = $paginator->lastPage();
                        $range = 2;
                        $pages = [];

                        $pages[] = 1;
                        for ($i = $current - $range; $i <= $current + $range; $i++) {
                            if ($i > 1 && $i < $last) $pages[] = $i;
                        }
                        if ($last > 1) $pages[] = $last;

                        $pages = array_unique($pages);
                        sort($pages);
                    ?>

                    <?php $prev = null; ?>
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($prev && $page > $prev + 1): ?>
                            <li><span class="px-2 text-gray-400 dark:text-gray-500">…</span></li>
                        <?php endif; ?>

                        <li>
                            <a href="<?php echo e($paginator->url($page)); ?>"
                               class="px-3 py-1.5 rounded-xl text-sm transition-all
                                      <?php echo e($page == $current
                                            ? 'bg-purple-600 text-white hover:bg-purple-700 shadow-sm'
                                            : 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600'); ?>">
                                <?php echo e($page); ?>

                            </a>
                        </li>

                        <?php $prev = $page; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    
                    <?php if($paginator->nextPageUrl()): ?>
                        <li>
                            <a href="<?php echo e($paginator->nextPageUrl()); ?>"
                               class="flex items-center justify-center w-9 h-9 rounded-xl
                                      bg-gray-200 dark:bg-gray-700
                                      hover:bg-gray-300 dark:hover:bg-gray-600
                                      transition-all">
                                <svg class="w-4 h-4 text-gray-700 dark:text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </nav>
        </div>
    </div>

</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/components/pagination.blade.php ENDPATH**/ ?>