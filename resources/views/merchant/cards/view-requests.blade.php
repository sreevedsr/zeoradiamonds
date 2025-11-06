<x-app-layout>
    @slot('title', 'View Card Requests')


    <!-- Requests Table Section -->
    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-7xl mx-auto text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Requests Table -->
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Holder Name</th>
                            <th class="px-4 py-3">Diamond Type</th>
                            <th class="px-4 py-3">Carat Weight</th>
                            <th class="px-4 py-3">Clarity</th>
                            <th class="px-4 py-3">Color</th>
                            <th class="px-4 py-3">Cut</th>
                            <th class="px-4 py-3">Requested At</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        {{-- @foreach ($requests as $index => $request) --}}
                        <tr
                            class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            {{-- <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-sm">{{ $request->holder_name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $request->diamond_type }}</td>
                                <td class="px-4 py-3 text-sm">{{ $request->carat_weight }} ct</td>
                                <td class="px-4 py-3 text-sm">{{ $request->clarity }}</td>
                                <td class="px-4 py-3 text-sm">{{ $request->color }}</td>
                                <td class="px-4 py-3 text-sm">{{ $request->cut }}</td>
                                <td class="px-4 py-3 text-sm">{{ $request->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex items-center space-x-2">
                                        {{-- Optional actions: Approve / Delete --}}
                            {{-- <form action="{{ route('merchant.cards.delete', $request->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Delete this request?')" class="text-red-600 hover:underline">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td> --}}
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>

            <!-- Pagination Example -->
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
