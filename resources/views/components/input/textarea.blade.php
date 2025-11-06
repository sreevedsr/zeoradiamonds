@props([
    'name',
    'rows' => 3,
    'value' => null,
])

@php
    $value = $value ?? old($name);
@endphp

<textarea
    name="{{ $name }}"
    rows="{{ $rows }}"
    {{ $attributes->merge([
        'class' => 'input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100'
    ]) }}
>{{ $value }}</textarea>
