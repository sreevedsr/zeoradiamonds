
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'value' => '',
    'readonly' => false,
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
    'value' => '',
    'readonly' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<input
    type="date"
    name="<?php echo e($name); ?>"
    value="<?php echo e(old($name, $value)); ?>"
    <?php echo e($readonly ? 'readonly' : ''); ?>

    <?php echo e($attributes->merge([
        'class' => 'w-full rounded-md border border-gray-300 dark:border-gray-600
                    bg-gray-50 dark:bg-gray-700 px-3 py-2 text-gray-800 dark:text-gray-100
                    focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-purple-600
                    transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed'
    ])); ?>

/>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/components/input/date.blade.php ENDPATH**/ ?>