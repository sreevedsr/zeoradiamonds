@props([
    'name',
    'type' => 'text',
    'model' => null,
    'value' => old($name),
])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    x-model="{{ $model ?? $name }}"
    value="{{ $value }}"
    {{ $attributes->merge([
        'class' => 'input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100'
    ]) }}
/>
