<x-app-layout>
    @slot('title', 'Zeeyame - Merchant Marketplace')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Marketplace - Diamond Stock
    </h2>

    <!-- Grid of cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 " style="
    grid-template-columns: repeat(3, minmax(0, 1fr));
">
        <!-- Card 1 -->
        <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-2 font-semibold text-gray-600 dark:text-gray-300">
                Diamond ID: D-001
            </h4>
            <p class="text-gray-600 dark:text-gray-400 mb-2">
                Carat Weight: 1.5 ct
            </p>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Clarity: VS1 | Color: F
            </p>
            <button class="px-4 py-2 w-full text-white bg-blue-600 rounded hover:bg-blue-700">
                Request Stock
            </button>
        </div>

        <!-- Card 2 -->
        <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-2 font-semibold text-gray-600 dark:text-gray-300">
                Diamond ID: D-002
            </h4>
            <p class="text-gray-600 dark:text-gray-400 mb-2">
                Carat Weight: 2.0 ct
            </p>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Clarity: VVS2 | Color: D
            </p>
            <button class="px-4 py-2 w-full text-white bg-blue-600 rounded hover:bg-blue-700">
                Request Stock
            </button>
        </div>

        <!-- Card 3 -->
        <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-2 font-semibold text-gray-600 dark:text-gray-300">
                Diamond ID: D-003
            </h4>
            <p class="text-gray-600 dark:text-gray-400 mb-2">
                Carat Weight: 1.2 ct
            </p>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Clarity: SI1 | Color: G
            </p>
            <button class="px-4 py-2 w-full text-white bg-blue-600 rounded hover:bg-blue-700">
                Request Stock
            </button>
        </div>

        <!-- Card 4 -->
        <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-2 font-semibold text-gray-600 dark:text-gray-300">
                Diamond ID: D-004
            </h4>
            <p class="text-gray-600 dark:text-gray-400 mb-2">
                Carat Weight: 1.2 ct
            </p>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Clarity: SI1 | Color: G
            </p>
            <button class="px-4 py-2 w-full text-white bg-blue-600 rounded hover:bg-blue-700">
                Request Stock
            </button>
        </div>

        <!-- Add more cards as needed -->
    </div>
</x-app-layout>
