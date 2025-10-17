<x-app-layout>
    @slot('title', 'Zeeyame - Add Card Details')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Card Details
    </h2>

    <div class="space-y-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Card Form Section -->
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="text-gray-900 dark:text-gray-100">
                @if (session('success'))
                    <div class="mb-4 text-green-500 font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('forms.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="card_title" class="block text-sm font-medium">Card Title</label>
                        <input type="text" name="card_title" id="card_title"
                               class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="card_description" class="block text-sm font-medium">Card Description</label>
                        <textarea name="card_description" id="card_description" rows="3"
                                  class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700"
                                  required></textarea>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
