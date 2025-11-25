<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => null,
    'name',
    'value' => null,
    'required' => false,
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
    'name',
    'value' => null,
    'required' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="flex flex-col" x-data="{ hasValue: '<?php echo e($value); ?>' !== '' }">
    <?php if($label): ?>
        <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">
            <?php echo e($label); ?>

        </label>
    <?php endif; ?>

    <input
        type="date"
        name="<?php echo e($name); ?>"
        value="<?php echo e($value); ?>"
        x-on:input="hasValue = $event.target.value !== ''"
        <?php if($required): ?> required <?php endif; ?>

        class="w-full rounded-lg border px-3 py-2
               dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200
               focus:ring focus:ring-purple-600/30 focus:border-purple-600
               transition-all"

        x-bind:class="{
            'text-gray-400 dark:text-gray-500': !hasValue,
            'text-gray-900 dark:text-gray-200': hasValue
        }"
    />
</div>
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/components/date-input.blade.php ENDPATH**/ ?>