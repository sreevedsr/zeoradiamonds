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
    'min' => null,
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
    'min' => null,
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

<div class="space-y-1">
    <?php if($label): ?>
        <label for="<?php echo e($name); ?>" class="text-sm font-medium text-gray-700 dark:text-gray-200">
            <?php echo e($label); ?>

            <?php if($required): ?>
                <span class="text-red-500">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <input id="<?php echo e($name); ?>" type="<?php echo e($type); ?>" name="<?php echo e($name); ?>"
        <?php if($model): ?> x-model="<?php echo e($model); ?>" <?php endif; ?>
        value="<?php echo e(is_array($value) ? '' : $value); ?>" placeholder="<?php echo e($placeholder); ?>"
        <?php if($readonly): ?> readonly <?php endif; ?> <?php if($required): ?> required <?php endif; ?>
        <?php if($step): ?> step="<?php echo e($step); ?>" <?php endif; ?>
        <?php if($min): ?> min="<?php echo e($min); ?>" <?php endif; ?>
        <?php echo e($attributes->merge([
            'class' => 'input-field w-full rounded-md border border-gray-300 px-3 py-2
                    focus:outline-none focus:ring-2 focus:ring-purple-600
                    dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100
                    hover:border-purple-400 transition duration-150',
        ])); ?> />
</div>
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/components/input/text.blade.php ENDPATH**/ ?>