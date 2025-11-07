<x-app-layout>
    @slot('title', 'Staff Registration')

    <div class="rounded-lg bg-white p-6 shadow-md dark:bg-gray-800 sm:p-8">
        <div class="mx-auto text-gray-900 dark:text-gray-100">

            <!-- Staff Registration Form -->
            <form method="POST" action="{{ route('admin.staff.store') }}" x-init="init();
            enableSequentialInput();
            $nextTick(() => focusFirstInput());">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <!-- Staff Code -->
                    <div>
                        <label for="code" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Staff Code <span class="text-red-500">*</span>
                        </label>
                        <x-input.text name="code" placeholder="Enter staff code" required
                            class="w-full hover:border-purple-400 transition duration-150" />
                    </div>

                    <!-- Staff Name -->
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Staff Name <span class="text-red-500">*</span>
                        </label>
                        <x-input.text name="name" placeholder="Enter staff name" required
                            class="w-full hover:border-purple-400 transition duration-150" />
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label for="address" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Address <span class="text-red-500">*</span>
                        </label>
                        <textarea name="address" rows="3" placeholder="Enter full address" required
                            class="input-field w-full rounded-md border border-gray-300 px-3 py-2
                            focus:outline-none focus:ring-2 focus:ring-purple-600
                            dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100
                            hover:border-purple-400 transition duration-150">{{ old('address') }}</textarea>
                    </div>

                    <!-- Phone No -->
                    <div>
                        <label for="phone_no" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Phone No. <span class="text-red-500">*</span>
                        </label>
                        <x-input.text name="phone_no" placeholder="Enter phone number" pattern="[0-9+\-\s]{7,15}"
                            title="Please enter a valid phone number" required
                            class="w-full hover:border-purple-400 transition duration-150" />
                    </div>

                </div>

                <!-- Save Button -->
                <div class="mt-6 text-right">
                    <button id="submitBtn" type="submit"
                        class="rounded-md bg-purple-600 px-5 py-2 font-medium text-white
                        hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
