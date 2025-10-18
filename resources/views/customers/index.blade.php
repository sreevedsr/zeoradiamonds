<x-app-layout>
    @slot('title', 'Zeeyame - Customers')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        View Customers
    </h2>

    <!-- Customers Table Section -->
    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-7xl mx-auto text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- No Data Message -->
            {{-- @if ($customers->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">No customers found.</p>
            @else --}}
                <!-- Customers Table -->
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Phone</th>
                                <th class="px-4 py-3">Address</th>
                                <th class="px-4 py-3">City</th>
                                <th class="px-4 py-3">State</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            {{-- @foreach ($customers as $index => $customer) --}}
                                <tr class="text-gray-700 dark:text-gray-400">
                                    {{-- <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $customer->name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $customer->email }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $customer->phone }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $customer->address }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $customer->city }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $customer->state }}</td> --}}
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex items-center space-x-2">
                                            {{-- <a href="{{ route('customers.show', $customer->id) }}" class="text-blue-600 hover:underline">View</a>
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this customer?')"
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

                <!-- Pagination Example -->
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    <span class="flex items-center col-span-3">
                        Showing 1–10 of 45
                    </span>
                    <span class="col-span-2"></span>
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        <nav aria-label="Table navigation">
                            <ul class="inline-flex items-center">
                                <li>
                                    <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                        aria-label="Previous">
                                        <svg class="w-4 h-4 fill-current" aria-hidden="true"
                                            viewBox="0 0 20 20">
                                            <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </li>
                                <li>
                                    <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                        1
                                    </button>
                                </li>
                                <li>
                                    <button class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                                        2
                                    </button>
                                </li>
                                <li>
                                    <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                        3
                                    </button>
                                </li>
                                <li>
                                    <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                        aria-label="Next">
                                        <svg class="w-4 h-4 fill-current" aria-hidden="true"
                                            viewBox="0 0 20 20">
                                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </span>
                </div>
            {{-- @endif --}}
        </div>
    </div>
</x-app-layout>
