<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => 'state_code',
    'label' => 'State Code',
    'stateCodes' => [],
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
    'name' => 'state_code',
    'label' => 'State Code',
    'stateCodes' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="relative" x-data="{
    openDropdown: false,
    searchQuery: '',
    selectedCode: '',
    stateCodes: <?php echo \Illuminate\Support\Js::from($stateCodes)->toHtml() ?>,
    selectState(state) {
        this.selectedCode = state.state_code;
        this.searchQuery = state.state_name;
        this.openDropdown = false;
    },
    get filteredStates() {
        return this.stateCodes.filter(s =>
            s.state_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
            s.state_code.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
            s.gstin_code.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
    }
}" x-cloak @click.outside="openDropdown = false">

    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
        <?php echo e($label); ?> <span class="text-red-500">*</span>
    </label>

    <div class="relative">
        <input type="text" placeholder="Search or select <?php echo e(strtolower($label)); ?>" x-model="searchQuery"
            @focus="openDropdown = true" @input="openDropdown = true" @keydown.escape.window="openDropdown = false"
            @keydown.enter.prevent="if(filteredStatesList.length>0) selectState(filteredStatesList[0])"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600 hover:border-purple-400 transition duration-150">

        <button type="button" @click="openDropdown = !openDropdown"
            class="absolute right-2 top-2.5 text-gray-500 dark:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300"
                :class="openDropdown ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </div>

    <div x-show="openDropdown" x-transition
        class="absolute z-10 mt-2 max-h-60 w-full overflow-y-auto rounded-lg border border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800 custom-scrollbar">
        <template x-if="filteredStatesList.length > 0">
            <ul>
                <template x-for="state in filteredStatesList" :key="state.state_code">
                    <li @click="selectState(state)"
                        class="cursor-pointer px-3 py-2 text-sm hover:bg-purple-100 dark:hover:bg-purple-700/40 dark:text-gray-100 border-b border-gray-100 dark:border-gray-700 last:border-0"
                        :class="selectedCode === state.state_code ? 'bg-purple-100 dark:bg-purple-700/40 font-medium' : ''">
                        <div class="flex flex-col">
                            <span class="text-base font-semibold text-gray-900 dark:text-gray-100"
                                x-text="'GST: ' + (state.gstin_code || '-')"></span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-0.5"
                                x-text="state.state_code + ' - ' + state.state_name"></span>
                        </div>
                    </li>
                </template>
            </ul>
        </template>

        <template x-if="filteredStatesList.length === 0">
            <div class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                No results found
            </div>
        </template>
    </div>

    <input type="hidden" :name="'<?php echo e($name); ?>'" x-model="selectedCode" required>
</div>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/components/input/state-dropdown.blade.php ENDPATH**/ ?>