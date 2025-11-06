<x-app-layout>
    @slot('title', 'Add Diamond Rate')

    <div class="mx-auto">
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            @if (session('success'))
                <div class="mb-4 text-green-600 font-medium bg-green-100 border border-green-300 rounded-md p-3">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-500 font-semibold">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.goldrates.storeDiamond') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Diamond Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Diamond Type
                        </label>
                        <input type="text" name="diamond_type" value="{{ old('diamond_type') }}" required
                            placeholder="Enter diamond type"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                            dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500
                            hover:border-blue-400 transition duration-150">
                    </div>

                    <!-- Diamond Rate -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Rate (per carat)
                        </label>
                        <input type="number" name="rate" value="{{ old('rate') }}" step="0.01" required
                            placeholder="Enter rate per carat"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                            dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500
                            hover:border-blue-400 transition duration-150">
                    </div>

                    <!-- Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Date
                        </label>
                        <input type="date" name="date" value="{{ old('date') }}" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md
                            dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500
                            hover:border-blue-400 transition duration-150">
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-start pt-4">
                    <button type="submit"
                        class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700
                        focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150">
                        Save Diamond Rate
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
