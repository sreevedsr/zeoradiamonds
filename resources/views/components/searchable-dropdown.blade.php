@props([
    'name',
    'api',
    'label' => 'Select Option',
    'placeholder' => 'Select...',
    'optionLabel' => 'name',
    'optionValue' => 'id',
    'autoSubmit' => false,
    'showClear' => true,
    'showSelectAll' => false,
])

<div
    x-data="dropdownComponent({
        apiUrl: '{{ $api }}',
        optionLabel: '{{ $optionLabel }}',
        optionValue: '{{ $optionValue }}'
    })"
    x-init="init('{{ request($name) }}')"
    class="w-60 relative"
>

    {{-- Label --}}
    <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">
        {{ $label }}
    </label>

    {{-- Hidden --}}
    <input x-ref="hiddenInput" type="hidden" name="{{ $name }}" />

    {{-- Selector --}}
    <div @click="toggle()"
         class="rounded-lg border px-3 py-2 bg-white dark:bg-gray-900 dark:border-gray-700 cursor-pointer flex justify-between items-center">

        <span class="truncate" x-text="selectedLabel || '{{ $placeholder }}'"></span>

        <svg class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>


    {{-- TELEPORTED DROPDOWN --}}
    <template x-teleport="body">
        <div x-show="open"
             x-ref="menu"
             @click.outside="close()"
             class="absolute bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg shadow max-h-64 overflow-auto"
             style="display:none"
        >

            {{-- Search --}}
            <input type="text"
                   x-model="searchQuery"
                   @input="filterOptions()"
                   placeholder="Search..."
                   class="w-full px-3 py-2 text-sm border-b dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200"
            />

            {{-- Clear --}}
            @if($showClear)
                <div @click="clearSelection()"
                     class="px-3 py-2 text-sm cursor-pointer text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                    ✖ Clear selection
                </div>
                <div class="border-b dark:border-gray-700"></div>
            @endif

            {{-- Options --}}
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
