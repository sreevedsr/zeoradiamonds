@props([
    'label' => null,
    'name',
    'value' => null,
    'required' => false,
])

<div class="flex flex-col" x-data="{ hasValue: '{{ $value }}' !== '' }">
    @if($label)
        <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif

    <input
        type="date"
        name="{{ $name }}"
        value="{{ $value }}"
        x-on:input="hasValue = $event.target.value !== ''"
        @if($required) required @endif

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
