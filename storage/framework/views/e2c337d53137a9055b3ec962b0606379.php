<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'api',
    'label' => 'Select Option',
    'placeholder' => 'Select...',
    'optionLabel' => 'name',
    'optionValue' => 'id',
    'autoSubmit' => false,
    'showClear' => true,
    'showSelectAll' => false,
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
    'name',
    'api',
    'label' => 'Select Option',
    'placeholder' => 'Select...',
    'optionLabel' => 'name',
    'optionValue' => 'id',
    'autoSubmit' => false,
    'showClear' => true,
    'showSelectAll' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    x-data="dropdownComponent({
        apiUrl: '<?php echo e($api); ?>',
        optionLabel: '<?php echo e($optionLabel); ?>',
        optionValue: '<?php echo e($optionValue); ?>'
    })"
    x-init="init('<?php echo e(request($name)); ?>')"
    class="w-60 relative"
>

    
    <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">
        <?php echo e($label); ?>

    </label>

    
    <input x-ref="hiddenInput" type="hidden" name="<?php echo e($name); ?>" />

    
    <div @click="toggle()"
         class="rounded-lg border px-3 py-2 bg-white dark:bg-gray-900 dark:border-gray-700 cursor-pointer flex justify-between items-center">

        <span class="truncate" x-text="selectedLabel || '<?php echo e($placeholder); ?>'"></span>

        <svg class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>


    
    <template x-teleport="body">
        <div x-show="open"
             x-ref="menu"
             @click.outside="close()"
             class="absolute bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg shadow max-h-64 overflow-auto"
             style="display:none"
        >

            
            <input type="text"
                   x-model="searchQuery"
                   @input="filterOptions()"
                   placeholder="Search..."
                   class="w-full px-3 py-2 text-sm border-b dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200"
            />

            
            <?php if($showClear): ?>
                <div @click="clearSelection()"
                     class="px-3 py-2 text-sm cursor-pointer text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                    ✖ Clear selection
                </div>
                <div class="border-b dark:border-gray-700"></div>
            <?php endif; ?>

            
            <template x-for="option in filteredOptions" :key="option[optionValue]">
                <div @click="choose(option)"
                     class="px-3 py-2 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700"
                     x-text="option[optionLabel]"></div>
            </template>

            <div x-show="filteredOptions.length === 0"
                 class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                No results found
            </div>

        </div>
    </template>

</div>
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/components/searchable-dropdown.blade.php ENDPATH**/ ?>