<x-app-layout>
    @slot('title', 'Zeeyame - Merchants')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        View Merchants
    </h2>

    <!-- Merchants Table Section -->
    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-7xl mx-auto text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Merchants Table -->
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Owner Name</th>
                            <th class="px-4 py-3">Business Name</th>
                            <th class="px-4 py-3">Created At</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($merchants as $index => $merchant)
                            <tr
                                class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <p>{{ $merchant->name }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $merchant->email }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm"></td>
                                <td class="px-4 py-3 text-sm">{{ $merchant->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex items-center space-x-2">
                                        {{-- <a href="{{ route('merchants.show', $merchant->id) }}" class="text-blue-600 hover:underline">View</a>
                                        <a href="{{ route('merchants.edit', $merchant->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                        <form action="{{ route('merchants.destroy', $merchant->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this merchant?')"
                                                class="text-red-600 hover:underline">
                                                Delete
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Example -->
            {{-- <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                    Showing {{ $merchants->firstItem() ?? 1 }}–{{ $merchants->lastItem() ?? count($merchants) }} of {{ $merchants->total() ?? count($merchants) }}
                </span>
                <span class="col-span-2"></span>
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    {{-- {{ $merchants->links('pagination::tailwind') }} --}}
            {{-- </span> --}}
            {{-- </div> --}}
            @include('components.pagination', [
                'from' => 1,
                'to' => 10,
                'total' => 45,
                'pages' => [1, 2, 3],
                'current' => 2,
            ])

        </div>
    </div>
</x-app-layout>
