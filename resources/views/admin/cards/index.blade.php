<x-app-layout>
    @slot('title', 'Zeeyame - Diamond Certificates')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        View Diamond Certificates
    </h2>

    <!-- Certificate Table Section -->
    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-7xl mx-auto text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- No Data Message -->
            {{-- @if ($cards->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">No diamond certificates found.</p>
            @else --}}
            <!-- Certificates Table -->
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Holder Name</th>
                            <th class="px-4 py-3">Certificate ID</th>
                            <th class="px-4 py-3">Diamond Type</th>
                            <th class="px-4 py-3">Carat Weight</th>
                            <th class="px-4 py-3">Clarity</th>
                            <th class="px-4 py-3">Color</th>
                            <th class="px-4 py-3">Cut</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        {{-- @foreach ($cards as $index => $card) --}}
                        <tr class="text-gray-700 dark:text-gray-400">
                            {{-- <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $card->holder_name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $card->certificate_id }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $card->diamond_type }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $card->carat_weight }} ct</td>
                                    <td class="px-4 py-3 text-sm">{{ $card->clarity }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $card->color }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $card->cut }}</td> --}}
                            <td class="px-4 py-3 text-sm">
                                <div class="flex items-center space-x-2">
                                    {{-- <a href="{{ route('cards.show', $card->id) }}"
                                                class="text-blue-600 hover:underline">View</a>
                                            <a href="{{ route('cards.edit', $card->id) }}"
                                                class="text-yellow-600 hover:underline">Edit</a>
                                            <form action="{{ route('cards.destroy', $card->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this certificate?')"
                                                    class="text-red-600 hover:underline">
                                                    Delete
                                                </button>
                                            </form> --}}
                                </div>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @include('components.pagination', [
                'from' => 1,
                'to' => 10,
                'total' => 45,
                'pages' => [1, 2, 3],
                'current' => 2,
            ])

            {{-- @endif --}}
        </div>
    </div>
</x-app-layout>
