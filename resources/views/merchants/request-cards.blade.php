<x-app-layout>
    @slot('title', 'Zeeyame - Diamond Certificates')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Request Diamond Certificates
    </h2>

    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded max-w-4xl mx-auto">
            {{ session('success') }}
        </div>
    @endif

    <!-- Request Specific Diamond Form -->
    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg max-w-4xl mx-auto mb-8">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Request a Specific Diamond</h3>
        <form action="{{ route('merchant.cards.request') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="holder_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Holder
                    Name</label>
                <input type="text" name="holder_name" id="holder_name" required
                    class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
            </div>

            <div>
                <label for="diamond_type"
                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Diamond Type</label>
                <input type="text" name="diamond_type" id="diamond_type" required
                    class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="carat_weight"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Carat Weight</label>
                    <input type="number" step="0.01" name="carat_weight" id="carat_weight" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div>
                    <label for="clarity"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Clarity</label>
                    <input type="text" name="clarity" id="clarity" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div>
                    <label for="color"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Color</label>
                    <input type="text" name="color" id="color" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
            </div>

            <div>
                <label for="cut"
                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Cut</label>
                <input type="text" name="cut" id="cut" required
                    class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    Submit Request
                </button>
            </div>
        </form>
    </div>

    <!-- Marketplace Grid -->
    <div class="max-w-7xl mx-auto grid">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Diamond Marketplace</h3>
        <div class="grid grid-cols-3 sm:grid-cols-2 gap-6">
            @php
                $dummyDiamonds = [
                    [
                        'diamond_type' => 'Round Brilliant',
                        'carat_weight' => 1.2,
                        'color' => 'D',
                        'clarity' => 'VVS1',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                    [
                        'diamond_type' => 'Princess Cut',
                        'carat_weight' => 0.8,
                        'color' => 'F',
                        'clarity' => 'VS2',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                    [
                        'diamond_type' => 'Emerald Cut',
                        'carat_weight' => 1.5,
                        'color' => 'G',
                        'clarity' => 'SI1',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                    [
                        'diamond_type' => 'Oval Cut',
                        'carat_weight' => 1.0,
                        'color' => 'H',
                        'clarity' => 'VS1',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                    [
                        'diamond_type' => 'Cushion Cut',
                        'carat_weight' => 0.9,
                        'color' => 'E',
                        'clarity' => 'VVS2',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                    [
                        'diamond_type' => 'Asscher Cut',
                        'carat_weight' => 1.3,
                        'color' => 'F',
                        'clarity' => 'SI2',
                        'image_url' => 'https://via.placeholder.com/150',
                    ],
                ];
            @endphp

            @foreach ($dummyDiamonds as $diamond)
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden flex flex-col">
                    <!-- Header -->
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200">
                            {{ $diamond['diamond_type'] }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $diamond['carat_weight'] }} ct |
                            {{ $diamond['color'] }} | {{ $diamond['clarity'] }}</p>
                    </div>

                    <!-- Image -->
                    <div class="flex justify-center items-center p-4 h-32">
                        <img src="{{ $diamond['image_url'] }}" alt="Diamond" class="h-full object-contain">
                    </div>

                    <!-- Form -->
                    <div class="p-4">
                        <form action="#" method="POST" class="space-y-3">
                            @csrf
                            <input type="hidden" name="diamond_id" value="dummy">

                            {{-- <div>
                                <label for="holder_name_{{ $loop->index }}"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-200">Holder
                                    Name</label>
                                <input type="text" name="holder_name" id="holder_name_{{ $loop->index }}" required
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-purple-500">
                            </div> --}}

                            <div class="flex justify-start">
                                <button type="submit"
                                    class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

</x-app-layout>
