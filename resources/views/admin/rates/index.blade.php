<x-app-layout>
    @slot('title', 'Manage Rates')

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Gold & Diamond Rates
    </h2>

    @if (session('success'))
        <div class="mb-4 text-green-600 dark:text-green-400">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Gold Rate Section -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-yellow-600">Gold Rate🪙</h3>
            <p class="mb-2 text-gray-600 dark:text-gray-300">
                Current:
                <span class="font-bold">{{ $latestGold->rate ?? 'Not Set' }} ₹</span>
            </p>
            <form action="{{ route('admin.rates.gold.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="number" name="rate" step="0.01" required
                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md px-3 py-2"
                    placeholder="Enter new gold rate">
                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                    Update Gold Rate
                </button>
            </form>

            <h4 class="mt-6 mb-2 font-semibold text-gray-700 dark:text-gray-200">Recent Updates</h4>
            <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                @foreach ($goldRates as $rate)
                    <li>{{ $rate->rate }} ₹ — <span class="text-xs">{{ $rate->created_at->diffForHumans() }}</span></li>
                @endforeach
            </ul>
        </div>

        <!-- Diamond Rate Section -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-blue-600">Diamond Rate💎</h3>
            <p class="mb-2 text-gray-600 dark:text-gray-300">
                Current:
                <span class="font-bold">{{ $latestDiamond->rate ?? 'Not Set' }} ₹</span>
            </p>
            <form action="{{ route('admin.rates.diamond.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="number" name="rate" step="0.01" required
                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md px-3 py-2"
                    placeholder="Enter new diamond rate">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Update Diamond Rate
                </button>
            </form>

            <h4 class="mt-6 mb-2 font-semibold text-gray-700 dark:text-gray-200">Recent Updates</h4>
            <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                @foreach ($diamondRates as $rate)
                    <li>{{ $rate->rate }} ₹ — <span class="text-xs">{{ $rate->created_at->diffForHumans() }}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
