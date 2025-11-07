<x-app-layout>
    @slot('title', 'Edit Diamond Certificate')

    <div class="space-y-6">
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <div class="mx-auto text-gray-900 dark:text-gray-100">

                <!-- Form -->
                <form method="POST" action="{{ route('admin.products.update', $card->id) }}" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Certificate ID -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                Certificate ID
                            </label>
                            <input type="text" name="certificate_id"
                                value="{{ old('certificate_id', $card->certificate_id) }}"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                required>
                        </div>

                        <!-- Diamond Purchase Location -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                Diamond Purchase Location
                            </label>
                            <input type="text" name="diamond_purchase_location"
                                value="{{ old('diamond_purchase_location', $card->diamond_purchase_location) }}"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                required>
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                Category
                            </label>
                            <input type="text" name="category" value="{{ old('category', $card->category) }}"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                required>
                        </div>

                        <!-- Diamond Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                Diamond Type
                            </label>
                            <input type="text" name="diamond_type"
                                value="{{ old('diamond_type', $card->diamond_type) }}"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                required>
                        </div>

                        <!-- Carat Weight -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                Carat Weight
                            </label>
                            <input type="number" step="0.01" name="carat_weight"
                                value="{{ old('carat_weight', $card->carat_weight) }}"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                required>
                        </div>

                        <!-- Clarity -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                Clarity
                            </label>
                            <input type="text" name="clarity" value="{{ old('clarity', $card->clarity) }}"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                required>
                        </div>

                        <!-- Color -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                Color
                            </label>
                            <select name="color"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                required>
                                <option value="" disabled>Select diamond color</option>
                                @foreach (range('D', 'Z') as $color)
                                    <option value="{{ $color }}"
                                        {{ old('color', $card->color) == $color ? 'selected' : '' }}>
                                        {{ $color }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Cut -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                Cut
                            </label>
                            <input type="text" name="cut" value="{{ old('cut', $card->cut) }}"
                                class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                required>
                        </div>

                        <!-- Diamond Certificate Image -->
                        <div x-data="{ preview: '{{ $card->diamond_image ? asset('storage/' . $card->diamond_image) : '' }}' }" class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                Diamond Certificate Image
                            </label>

                            <label for="diamond_image"
                                class="relative flex flex-col items-center justify-center w-full h-52 border-2 border-dashed border-gray-400 dark:border-gray-600 rounded-lg px-6 py-8 bg-transparent dark:bg-gray-800 hover:border-purple-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all cursor-pointer overflow-hidden group">

                                <input id="diamond_image" name="diamond_image" type="file" accept="image/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview">

                                <!-- Default Upload Prompt -->
                                <div x-show="!preview"
                                    class="flex flex-col items-center justify-center text-center space-y-2">
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                                        class="w-10 h-10 text-gray-400 dark:text-gray-500 group-hover:text-purple-500 transition-colors">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" />
                                    </svg>
                                    <p class="text-sm font-semibold text-purple-600 dark:text-purple-400">Upload
                                        New Certificate Image</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>

                                <!-- Preview -->
                                <div x-show="preview" class="flex flex-col items-center p-3">
                                    <img :src="preview" alt="Preview"
                                        class="w-24 h-24 object-cover rounded-md border border-gray-300 dark:border-gray-600 shadow-md p-1 bg-white dark:bg-gray-700">
                                    <button type="button" @click="preview = ''"
                                        class="mt-4 px-3 py-1.5 text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 rounded-md font-medium transition-all duration-200">
                                        Remove
                                    </button>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end items-center mt-4 space-x-3">
                        <a href="{{ route('admin.products.index') }}">
                            <x-secondary-button>
                                Cancel
                            </x-secondary-button>
                        </a>
                        <button type="submit">
                            <x-primary-button>
                                Update Certificate
                            </x-primary-button>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
