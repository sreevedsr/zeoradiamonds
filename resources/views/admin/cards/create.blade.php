<x-app-layout>
    @slot('title', 'Zeeyame - Add Diamond Certificate')

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Diamond Certificate
    </h2>

    <!-- Diamond Certificate Form Section -->
    <div class="space-y-6">
        <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8">
            <div class="mx-auto text-gray-900 dark:text-gray-100">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-4 rounded-md border border-green-300 bg-green-100 p-3 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-4 rounded-md border border-red-300 bg-red-100 p-3 text-red-700">
                        <ul class="list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('admin.cards.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Grid Layout -->
                    <div x-data="{ openDropdown: null }" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Certificate ID -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Certificate ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="certificate_id"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                placeholder="Enter unique certificate ID" required>
                        </div>
                        <!-- Diamond Purchase Location -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Diamond Purchase Location <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="diamond_purchase_location"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                placeholder="Enter the location where you purchased the diamond" required>
                        </div>

                        <!-- Diamond Type -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="category"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                placeholder="e.g., D6, D7" required>
                        </div>

                        <!-- Diamond Shape -->
                        <div x-data="{ selectedShape: '' }" class="relative">
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Diamond Shape <span class="text-red-500">*</span>
                            </label>

                            <!-- Dropdown trigger -->
                            <button type="button"
                                @click="openDropdown === 'shape' ? openDropdown = null : openDropdown = 'shape'"
                                class="flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                <span x-text="selectedShape || 'Select diamond shape'"
                                    :class="selectedShape ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="ml-2 h-4 w-4 transform transition-transform duration-300 dark:text-gray-100"
                                    :class="openDropdown ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown options as cards -->
                            <div x-show="openDropdown === 'shape'" @click.outside="openDropdown = null"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                class="absolute z-10 mt-2 max-h-64 w-full origin-top overflow-y-auto rounded-lg border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-700 dark:bg-gray-800 custom-scrollbar">

                                <div class="grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 ">
                                    @foreach (['Round', 'Pear', 'Princess', 'Marquise', 'Emerald', 'Cushion Brilliant', 'Cushion Modified', 'Asscher', 'Sq. Emerald', 'Oval', 'Radiant', 'Heart', 'European Cut', 'Old Miner', 'Baguette', 'Briolette', 'Bullets', 'Calf', 'Half Moon', 'Hexagonal', 'Kite', 'Lozenge', 'Octagonal', 'Pentagonal', 'Rose', 'Shield', 'Square', 'Square Radiant', 'Star', 'Tapered Baguette', 'Tapered Bullet', 'Trapezoid', 'Triangular', 'Trilliant', 'Other'] as $shape)
                                        <div @click="selectedShape = '{{ $shape }}'; openDropdown = null"
                                            class="flex items-center justify-center cursor-pointer select-none rounded-md border px-3 py-2 text-center text-sm font-medium transition-all duration-200"
                                            :class="selectedShape === '{{ $shape }}'
                                                ?
                                                'border-purple-600 bg-purple-100 dark:bg-purple-700 text-purple-900 dark:text-white shadow-sm' :
                                                'border-gray-300 dark:border-gray-600 hover:border-purple-400 hover:bg-purple-50 dark:hover:border-purple-400 dark:hover:bg-purple-700/30 dark:text-gray-200'">
                                            {{ $shape }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Hidden input for form submission -->
                            <input type="hidden" name="diamond_shape" x-model="selectedShape" required>
                        </div>

                        <!-- Carat Weight -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Carat Weight <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="carat_weight"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                placeholder="e.g., 1.25" required>
                        </div>

                        <!-- Color -->
                        <div x-data="{ open: false, selectedColor: '' }" class="relative">
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Color <span class="text-red-500">*</span>
                            </label>

                            <!-- Dropdown trigger -->
                            <button type="button" @click="open = !open"
                                class="flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                <span x-text="selectedColor || 'Select diamond color'"
                                    :class="selectedColor ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="ml-2 h-4 w-4 transform transition-transform duration-300 dark:text-gray-100"
                                    :class="open ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown options as cards -->
                            <div x-show="open" @click.outside="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                class="absolute z-10 mt-2 grid  w-full grid-cols-7 gap-2 overflow-y-auto rounded-lg border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-700 dark:bg-gray-800">

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

                            <!-- Hidden input for form submission -->
                            <input type="hidden" name="color" x-model="selectedColor" required>
                        </div>

                        <!-- Clarity Dropdown with Card Options -->
                        <div x-data="{ open: false, selectedClarity: '' }" class="relative">
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Clarity <span class="text-red-500">*</span>
                            </label>

                            <!-- Dropdown trigger -->
                            <button type="button" @click="open = !open"
                                class="flex w-full cursor-pointer items-center justify-between rounded-md border border-gray-300 px-3 py-2 transition focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                <span x-text="selectedClarity || 'Select diamond clarity'"
                                    :class="selectedClarity ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': open }"
                                    class="h-5 w-5 transition-transform duration-200" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown options as cards -->
                            <div x-show="open" @click.outside="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                class="absolute z-10 mt-2 grid max-h-[140px] w-full grid-cols-2 gap-2 overflow-y-auto rounded-lg border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-700 dark:bg-gray-800 sm:grid-cols-3 lg:grid-cols-5">

                                <!-- Card options -->
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

                            <!-- Hidden input for form submission -->
                            <input type="hidden" name="clarity" x-model="selectedClarity" required>
                        </div>

                        <!-- Cut Selection -->
                        <div x-data="{ open: false, selectedCut: '' }" class="relative">
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Cut <span class="text-red-500">*</span>
                            </label>

                            <!-- Hidden input -->
                            <input type="hidden" name="cut" x-model="selectedCut" required>

                            <!-- Dropdown Button -->
                            <button type="button" @click="open = !open"
                                class="flex w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                <span x-text="selectedCut || 'Select Cut'"
                                    :class="selectedCut ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400'"></span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="ml-2 h-4 w-4 transform transition-transform duration-300"
                                    :class="open ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Options -->
                            <div x-show="open" @click.outside="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
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
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Certificate Valuation <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="valuation"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                placeholder="Enter Valuation of the card" required>
                        </div>

                        {{-- <!-- Finish -->
                        <div x-data="{ open: null }" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach (['Cut', 'Polish', 'Symmetry'] as $attribute)
                                <div class="relative">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                        {{ $attribute }} <span class="text-red-500">*</span>
                                    </label>

                                    <!-- Toggle Button -->
                                    <button type="button"
                                        @click="open === '{{ strtolower($attribute) }}' ? open = null : open = '{{ strtolower($attribute) }}'"
                                        class="w-full px-3 py-2 flex justify-between items-center rounded-md border border-gray-300 dark:border-gray-600
                       dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600 transition-all duration-200">
                                        <span
                                            x-text="$refs['{{ strtolower($attribute) }}_label']?.value || 'Select {{ $attribute }}'"></span>

                                        <!-- Dropdown Icon -->
                                        <svg :class="open === '{{ strtolower($attribute) }}' ? 'rotate-180' : 'rotate-0'"
                                            class="w-4 h-4 ml-2 transform transition-transform duration-200 text-gray-500 dark:text-gray-300"
                                            fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <!-- Hidden input for storing the selected value -->
                                    <input type="hidden" name="{{ strtolower($attribute) }}"
                                        x-ref="{{ strtolower($attribute) }}_label" required>

                                    <!-- Options Grid -->
                                    <div x-show="open === '{{ strtolower($attribute) }}'" @click.away="open = null"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 -translate-y-2"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 -translate-y-2"
                                        class="absolute z-10 mt-2 w-full bg-white dark:bg-gray-800 border border-gray-300
           dark:border-gray-600 rounded-lg shadow-lg p-2 grid grid-cols-1 lg:grid-cols-2 gap-2">
                                        @foreach (['Poor', 'Fair', 'Good', 'Very Good', 'Excellent', 'Ideal'] as $option)
                                            <button type="button"
                                                @click="$refs['{{ strtolower($attribute) }}_label'].value = '{{ $option }}'; open = null;"
                                                class="w-full text-center px-2 py-2 rounded-md border border-gray-300
                   dark:border-gray-700 dark:bg-gray-700/30 hover:bg-purple-100 dark:hover:bg-purple-600/30
                   transition-all duration-150 focus:ring-2 focus:ring-purple-500">
                                                {{ $option }}
                                            </button>
                                        @endforeach
                                    </div>

                                </div>
                            @endforeach
                        </div> --}}
                        <!-- Diamond Certificate Upload -->
                        <div x-data="{ preview: null }" class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Diamond Certificate Image
                            </label>

                            <label for="diamond_image"
                                class="group relative flex h-52 w-full cursor-pointer flex-col items-center justify-center overflow-hidden rounded-lg border-2 border-dashed border-gray-400 bg-transparent px-6 py-8 transition-all hover:border-purple-500 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700">

                                <!-- File Input -->
                                <input id="diamond_image" name="diamond_image" type="file" accept="image/*"
                                    class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
                                    @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">

                                <!-- Upload Icon & Text (Hidden when preview exists) -->
                                <div x-show="!preview"
                                    class="flex flex-col items-center justify-center space-y-2 text-center transition-opacity">
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                                        class="h-10 w-10 text-gray-400 transition-colors group-hover:text-purple-500 dark:text-gray-500">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" />
                                    </svg>
                                    <p class="text-sm font-semibold text-purple-600 dark:text-purple-400">Upload
                                        Certificate Image</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500">PNG, JPG up to 10MB</p>
                                </div>

                                <!-- Preview Image (Shown when uploaded) -->
                                <div x-show="preview" class="flex flex-col items-center p-3">
                                    <img :src="preview" alt="Preview"
                                        class="h-24 w-24 rounded-md border border-gray-300 bg-white object-cover p-1 shadow-md dark:border-gray-600 dark:bg-gray-700">
                                    <button type="button" @click="preview = null"
                                        class="text-m mt-4 rounded-md px-3 py-1.5 font-medium transition-all duration-200 hover:text-white">
                                        Remove
                                    </button>
                                </div>
                            </label>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="mt-4 rounded-md bg-purple-600 px-6 py-2 text-white transition duration-150 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            Save Certificate
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
