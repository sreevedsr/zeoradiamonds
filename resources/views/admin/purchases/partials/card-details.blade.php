<!-- Diamond Card Details Section -->

<div x-data="{ openDropdown: null }" class="grid grid-cols-1 gap-6 md:grid-cols-2">

    <!-- Certificate ID -->
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Certificate ID <span class="text-red-500">*</span>
        </label>
        <input type="text" name="certificate_id" placeholder="Enter unique certificate ID" required
            class="input-field w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Color -->
    <div x-data="{ open: false, selectedColor: '' }" class="relative">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Color <span class="text-red-500">*</span>
        </label>
        <button type="button" @click="open = !open" data-type="dropdown"
            class="input-field flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            <span x-text="selectedColor || 'Select diamond color'"
                :class="selectedColor ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
            <svg xmlns="http://www.w3.org/2000/svg"
                class="ml-2 h-4 w-4 transform transition-transform duration-300 dark:text-gray-100"
                :class="open ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" @click.outside="open = false" x-transition
            class="absolute z-10 mt-2 grid w-full grid-cols-7 gap-2 overflow-y-auto rounded-lg border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-700 dark:bg-gray-800">
            @foreach (range('D', 'Z') as $color)
                <div @click="selectedColor = '{{ $color }}'; open = false"
                    class="cursor-pointer select-none rounded-md border px-3 py-2 text-center text-sm font-medium transition-all duration-200"
                    :class="selectedColor === '{{ $color }}'
                        ?
                        'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-900 dark:text-white shadow-sm' :
                        'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200'">
                    {{ $color }}
                </div>
            @endforeach
        </div>
        <input type="hidden" name="color" x-model="selectedColor" required>
    </div>

    <!-- Clarity -->
    <div x-data="{ open: false, selectedClarity: '' }" class="relative">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Clarity <span class="text-red-500">*</span>
        </label>
        <button type="button" @click="open = !open" data-type="dropdown"
            class="input-field flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2 transition focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            <span x-text="selectedClarity || 'Select diamond clarity'"
                :class="selectedClarity ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': open }"
                class="h-5 w-5 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" @click.outside="open = false" x-transition
            class="absolute z-10 mt-2 grid max-h-[140px] w-full grid-cols-2 gap-2 overflow-y-auto rounded-lg border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-700 dark:bg-gray-800 sm:grid-cols-3 lg:grid-cols-5">
            @foreach (['FL', 'IF', 'VVS1', 'VVS2', 'VS1', 'VS2', 'SI1', 'SI2', 'SI3', 'I1'] as $clarity)
                <div @click="selectedClarity = '{{ $clarity }}'; open = false"
                    class="cursor-pointer select-none rounded-md border px-3 py-2 text-center text-sm font-medium transition-all duration-200"
                    :class="selectedClarity === '{{ $clarity }}'
                        ?
                        'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-900 dark:text-white shadow-sm' :
                        'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200'">
                    {{ $clarity }}
                </div>
            @endforeach
        </div>
        <input type="hidden" name="clarity" x-model="selectedClarity" required>
    </div>

    <!-- Cut Selection -->
    <div x-data="{ open: false, selectedCut: '' }" class="relative">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Cut <span class="text-red-500">*</span>
        </label>
        <input type="hidden" name="cut" x-model="selectedCut" required>
        <button type="button" @click="open = !open" data-type="dropdown"
            class="input-field flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            <span x-text="selectedCut || 'Select Cut'"
                :class="selectedCut ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 transform transition-transform duration-300"
                :class="open ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" @click.outside="open = false" x-transition
            class="absolute z-50 mt-2 grid w-full origin-top grid-cols-2 gap-3 rounded-lg border border-gray-300 bg-white p-3 shadow-lg dark:border-gray-600 dark:bg-gray-800">
            @foreach (['Poor', 'Fair', 'Good', 'Very Good', 'Excellent', 'Ideal'] as $cut)
                <div @click="selectedCut = '{{ $cut }}'; open = false"
                    class="cursor-pointer select-none rounded-md border px-3 py-2 text-center transition-all duration-200"
                    :class="selectedCut === '{{ $cut }}'
                        ?
                        'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-800 dark:text-white shadow-sm' :
                        'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200'">
                    {{ $cut }}
                </div>
            @endforeach
        </div>
    </div>

    <!-- Diamond Certificate Upload -->
    <div x-data="{ preview: null }" class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Diamond Certificate Image
        </label>
        <label for="diamond_image"
            class="group relative flex h-52 w-full cursor-pointer flex-col items-center justify-center overflow-hidden rounded-lg border-2 border-dashed border-gray-400 bg-transparent px-6 py-8 transition-all hover:border-purple-500 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700">
            <input id="diamond_image" name="diamond_image" type="file" accept="image/*"
                class="absolute inset-0 h-full w-full cursor-pointer opacity-0 input-field"
                @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
            <div x-show="!preview"
                class="flex flex-col items-center justify-center space-y-2 text-center transition-opacity">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                    class="h-10 w-10 text-gray-400 transition-colors group-hover:text-purple-500 dark:text-gray-500">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" />
                </svg>
                <p class="text-sm font-semibold text-purple-600 dark:text-purple-400">Upload Certificate Image</p>
                <p class="text-xs text-gray-400 dark:text-gray-500">PNG, JPG up to 10MB</p>
            </div>
            <div x-show="preview" class="flex flex-col items-center p-3">
                <img :src="preview" alt="Preview"
                    class="h-24 w-24 rounded-md border border-gray-300 bg-white object-cover p-1 shadow-md dark:border-gray-600 dark:bg-gray-700">
                <button type="button" @click="preview = null"
                    class="mt-4 rounded-md px-3 py-1.5 text-sm font-medium text-gray-600 hover:bg-purple-600 hover:text-white dark:text-gray-300 dark:hover:bg-purple-700">
                    Remove
                </button>
            </div>
        </label>
    </div>
</div>
