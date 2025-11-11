@props([
    'label' => null,
    'name' => null,
    'model' => null,
    'readonly' => false,
    'required' => false,
    'placeholder' => '',
    'step' => null,
    'type' => 'text',
    'value' => null,
])

@php
    $value = $value ?? ($errors->any() ? old($name) : '');
@endphp

<input
    type="{{ $type }}"
    name="{{ $name }}"
    @if ($model) x-model="{{ $model }}" @endif
    value="{{ $value }}"
    {{ $attributes->merge([
        'class' => 'input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100'
    ]) }}
/>
