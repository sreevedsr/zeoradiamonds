@props([
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
])

@php
    $value = $value ?? ($errors->any() ? old($name) : '');
@endphp

<div class="space-y-1">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700 dark:text-gray-200">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}"
        @if ($model) x-model="{{ $model }}" @endif value="{{ $value }}"
        placeholder="{{ $placeholder }}" @if ($readonly) readonly @endif
        @if ($required) required @endif
        @if ($step) step="{{ $step }}" @endif
        @if ($min) min="{{ $min }}" @endif
        {{ $attributes->merge([
            'class' =>
                'input-field w-full rounded-md border border-gray-300 px-3 py-2
                                focus:outline-none focus:ring-2 focus:ring-purple-600
                                dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100
                                hover:border-purple-400 transition duration-150
                                ' .
                ($readonly ? 'bg-gray-100 dark:bg-gray-800 cursor-not-allowed text-gray-700 dark:text-gray-300' : ''),
        ]) }} />
</div>
