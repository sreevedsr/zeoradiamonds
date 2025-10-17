<x-app-layout>
    @slot('title', 'Zeeyame - Merchants')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Merchants
    </h2>

    <div class="space-y-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Merchants Table Card -->
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="text-gray-900 dark:text-gray-100">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="border px-4 py-2 text-left">ID</th>
                                <th class="border px-4 py-2 text-left">Name</th>
                                <th class="border px-4 py-2 text-left">Email</th>
                                <th class="border px-4 py-2 text-left">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($merchants as $merchant)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="border px-4 py-2">{{ $merchant->id }}</td>
                                    <td class="border px-4 py-2">{{ $merchant->name }}</td>
                                    <td class="border px-4 py-2">{{ $merchant->email }}</td>
                                    <td class="border px-4 py-2">{{ $merchant->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
