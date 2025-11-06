<x-app-layout>
    @slot('title', 'Available Diamond Certificates')

    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-5xl mx-auto text-gray-900 dark:text-gray-100 space-y-8">

            <!-- Success / Error Messages -->
            @if (session('success'))
                <div class="p-3 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="p-3 bg-red-200 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Available Cards Table -->
            <div>
                <h3 class="text-lg font-semibold my-4">Your Available Certificates</h3>
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Certificate ID</th>
                                <th class="px-4 py-3">Diamond Type</th>
                                <th class="px-4 py-3">Carat Weight</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            {{-- @forelse ($cards as $index => $card) --}}
                            <tr class="text-gray-700 dark:text-gray-400">
                                {{-- <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-sm">{{ $card->certificate_id }}</td>
                                <td class="px-4 py-3 text-sm">{{ $card->diamond_type }}</td>
                                <td class="px-4 py-3 text-sm">{{ $card->carat_weight }} ct</td>
                                <td class="px-4 py-3 text-sm">
                                    @if($card->is_assigned)
                                        <span class="text-red-600 font-semibold">Assigned</span>
                                    @else
                                        <span class="text-green-600 font-semibold">Available</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if(!$card->is_assigned)
                                        <form action="{{ route('merchant.assignCard', $card->id) }}" method="POST">
                                            @csrf
                                            <button class="px-3 py-1 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                                                Assign
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td> --}}
                            </tr>
                            {{-- @empty --}}
                            {{-- <tr>
                                <td colspan="6" class="px-4 py-3 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No available certificates found.
                                </td>
                            </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
