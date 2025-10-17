<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Card Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 text-green-500 font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('cards.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Card Title</label>
                            <input type="text" name="title" class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Card Description</label>
                            <textarea name="description" rows="4" class="mt-1 block w-full p-2 border rounded-md dark:bg-gray-700" required></textarea>
                        </div>

                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Save Card
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
