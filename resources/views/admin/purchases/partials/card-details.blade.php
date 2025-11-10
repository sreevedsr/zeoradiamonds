<div x-data="{ openDropdown: null }" class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Certificate ID <span class="text-red-500">*</span>
        </label>
        <input type="text" name="certificate_id" x-model="item.certificate_id" placeholder="Enter unique certificate ID"
            required
            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none
            focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <div x-data="{ open: false }" class="relative">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Color <span class="text-red-500">*</span>
        </label>
        <button type="button" @click="open = !open"
            class="flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            <span x-text="item.color || 'Select diamond color'"
                :class="item.color ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 transform transition-transform duration-300"
                :class="open ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" @click.outside="open = false" x-transition
            class="absolute z-10 mt-2 grid w-full grid-cols-7 gap-2 rounded-lg border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-700 dark:bg-gray-800">
            @foreach (range('D', 'Z') as $color)
                <div @click="item.color = '{{ $color }}'; open = false"
                    class="cursor-pointer select-none rounded-md border px-3 py-2 text-center text-sm font-medium
                    transition-all duration-200"
                    :class="item.color === '{{ $color }}' ?
                        'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-900 dark:text-white shadow-sm' :
                        'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200'">
                    {{ $color }}
                </div>
            @endforeach
        </div>
    </div>

    <div x-data="{ open: false }" class="relative">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Clarity <span class="text-red-500">*</span>
        </label>
        <button type="button" @click="open = !open"
            class="flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            <span x-text="item.clarity || 'Select diamond clarity'"
                :class="item.clarity ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': open }"
                class="h-5 w-5 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" @click.outside="open = false" x-transition
            class="absolute z-10 mt-2 grid max-h-[140px] w-full grid-cols-2 gap-2 overflow-y-auto rounded-lg border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-700 dark:bg-gray-800 sm:grid-cols-3 lg:grid-cols-5">
            @foreach (['FL', 'IF', 'VVS1', 'VVS2', 'VS1', 'VS2', 'SI1', 'SI2', 'SI3', 'I1'] as $clarity)
                <div @click="item.clarity = '{{ $clarity }}'; open = false"
                    class="cursor-pointer select-none rounded-md border px-3 py-2 text-center text-sm font-medium
                    transition-all duration-200"
                    :class="item.clarity === '{{ $clarity }}' ?
                        'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-900 dark:text-white shadow-sm' :
                        'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200'">
                    {{ $clarity }}
                </div>
            @endforeach
        </div>
    </div>

    <div x-data="{ open: false }" class="relative">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Cut <span
                class="text-red-500">*</span></label>
        <button type="button" @click="open = !open"
            class="flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2
            focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            <span x-text="item.cut || 'Select Cut'"
                :class="item.cut ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 transform transition-transform duration-300"
                :class="open ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" @click.outside="open = false" x-transition
            class="absolute z-50 mt-2 grid w-full origin-top grid-cols-2 gap-3 rounded-lg border border-gray-300 bg-white p-3 shadow-lg dark:border-gray-600 dark:bg-gray-800">
            @foreach (['Poor', 'Fair', 'Good', 'Very Good', 'Excellent', 'Ideal'] as $cut)
                <div @click="item.cut = '{{ $cut }}'; open = false"
                    class="cursor-pointer select-none rounded-md border px-3 py-2 text-center transition-all duration-200"
                    :class="item.cut === '{{ $cut }}' ?
                        'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-800 dark:text-white shadow-sm' :
                        'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200'">
                    {{ $cut }}
                </div>
            @endforeach
        </div>
    </div>

    <div x-data="{ preview: null }">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Certificate Image
        </label>
        <label for="diamond_image"
            class="group relative flex w-full cursor-pointer flex-col items-center justify-center overflow-hidden rounded-lg border-2 border-dashed border-gray-400 bg-transparent px-6 py-8 transition-all hover:border-purple-500 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700">
            <input id="diamond_image" name="diamond_image" type="file" accept="image/*"
                class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
                @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null; item.diamond_image = $event.target.files[0]">
            <div x-show="!preview"
                class="flex flex-col items-center justify-center space-y-2 text-center transition-opacity">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3v12" />
                    <path d="m17 8-5-5-5 5" />
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                </svg>
                <p class="text-sm font-semibold text-purple-600 dark:text-purple-400">Upload Certificate Image</p>
                <p class="text-xs text-gray-400 dark:text-gray-500">PNG, JPG up to 10MB</p>
            </div>
            <div x-show="preview" class="flex flex-col items-center p-3">
                <img :src="preview" alt="Preview"
                    class="h-24 w-24 rounded-md border border-gray-300 bg-white object-cover p-1 shadow-md dark:border-gray-600 dark:bg-gray-700">
                <button type="button" @click="preview = null; item.diamond_image = null"
                    class="mt-4 rounded-md px-3 py-1.5 text-sm font-medium text-gray-600 hover:bg-purple-600 hover:text-white dark:text-gray-300 dark:hover:bg-purple-700">
                    Remove
                </button>
            </div>
        </label>
    </div>
    <div x-data="{ preview: null }">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
            Product Image
        </label>
        <label for="diamond_image"
            class="group relative flex w-full cursor-pointer flex-col items-center justify-center overflow-hidden rounded-lg border-2 border-dashed border-gray-400 bg-transparent px-6 py-8 transition-all hover:border-purple-500 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700">
            <input id="diamond_image" name="diamond_image" type="file" accept="image/*"
                class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
                @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null; item.diamond_image = $event.target.files[0]">
            <div x-show="!preview"
                class="flex flex-col items-center justify-center space-y-2 text-center transition-opacity">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                <path d="M12 3v12" />
                    <path d="m17 8-5-5-5 5" />
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                </svg>
                <p class="text-sm font-semibold text-purple-600 dark:text-purple-400">Upload Product Image</p>
                <p class="text-xs text-gray-400 dark:text-gray-500">PNG, JPG up to 10MB</p>
            </div>
            <div x-show="preview" class="flex flex-col items-center p-3">
                <img :src="preview" alt="Preview"
                    class="h-24 w-24 rounded-md border border-gray-300 bg-white object-cover p-1 shadow-md dark:border-gray-600 dark:bg-gray-700">
                <button type="button" @click="preview = null; item.diamond_image = null"
                    class="mt-4 rounded-md px-3 py-1.5 text-sm font-medium text-gray-600 hover:bg-purple-600 hover:text-white dark:text-gray-300 dark:hover:bg-purple-700">
                    Remove
                </button>
            </div>
        </label>
    </div>
</div>
