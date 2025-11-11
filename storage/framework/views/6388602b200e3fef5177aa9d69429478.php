<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => null,
    'name' => null,
    'model' => null,
    'readonly' => false,
    'required' => false,
    'placeholder' => '',
    'step' => null,
    'type' => 'text',
    'value' => null,
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
    'label' => null,
    'name' => null,
    'model' => null,
    'readonly' => false,
    'required' => false,
    'placeholder' => '',
    'step' => null,
    'type' => 'text',
    'value' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $value = $value ?? ($errors->any() ? old($name) : '');
?>

<input
    type="<?php echo e($type); ?>"
    name="<?php echo e($name); ?>"
    <?php if($model): ?> x-model="<?php echo e($model); ?>" <?php endif; ?>
    value="<?php echo e($value); ?>"
    <?php echo e($attributes->merge([
        'class' => 'input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100'
    ])); ?>

/>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/components/input/text.blade.php ENDPATH**/ ?>