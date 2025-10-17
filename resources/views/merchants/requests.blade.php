<x-app-layout>
    @slot('title', 'Zeeyame - Merchant Requests')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Merchant Requests
    </h2>

    <div class="space-y-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- Requests Table Card -->
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="text-gray-900 dark:text-gray-100">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- @if($requests->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400">No requests have been made yet.</p>
                @else --}}
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2 text-left">ID</th>
                                    <th class="border px-4 py-2 text-left">Merchant Name</th>
                                    <th class="border px-4 py-2 text-left">Card Name</th>
                                    <th class="border px-4 py-2 text-left">Requested On</th>
                                    <th class="border px-4 py-2 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach($requests as $request) --}}
                                    {{-- <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="border px-4 py-2">{{ $request->id }}</td>
                                        <td class="border px-4 py-2">{{ $request->merchant->name }}</td>
                                        <td class="border px-4 py-2">{{ $request->card->title }}</td>
                                        <td class="border px-4 py-2">{{ $request->created_at->format('d M Y') }}</td>
                                        <td class="border px-4 py-2">{{ ucfirst($request->status) }}</td>
                                    </tr> --}}
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                {{-- @endif --}}

            </div>
        </div>
    </div>
</x-app-layout>
