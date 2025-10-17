<x-app-layout>
    @slot('title', 'Zeeyame - Add Merchant')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Merchant
    </h2>

    <div class="space-y-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Merchant Form Section -->
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="text-gray-900 dark:text-gray-100">

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('merchants.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Password</label>
                        <input type="password" name="password"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               required>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors duration-150">
                        Add Merchant
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
