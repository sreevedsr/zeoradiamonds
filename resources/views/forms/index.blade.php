<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Card Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Your form goes here -->
                <form action="{{ route('forms.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="card_title" class="block text-sm font-medium text-gray-700">Card Title</label>
                        <input type="text" name="card_title" id="card_title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="card_description" class="block text-sm font-medium text-gray-700">Card Description</label>
                        <textarea name="card_description" id="card_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                    </div>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
