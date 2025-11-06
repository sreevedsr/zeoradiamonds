<x-app-layout>
    @slot('title', 'Diamond Certificates')

    <!-- Certificate Table Section -->
    <div class="bg-white px-6 py-2 shadow dark:bg-gray-800 rounded-lg ">
        <div class="mx-auto max-w-7xl text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 rounded bg-green-200 p-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Certificates Table -->
            <x-table :headers="['#', 'Certificate ID', 'Diamond Shape', 'Carat Weight', 'Clarity', 'Color', 'Cut', 'Actions']" :from="1" :to="$cards->count()" :total="$cards->count()" :pages="[1]"
                :current="1" :route="route('admin.products.index')" :searchQuery="request('search', '')">
                @forelse ($cards as $index => $card)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm">{{ $card->certificate_id }}</td>
                        <td class="px-4 py-3 text-sm">{{ $card->diamond_shape }}</td>
                        <td class="px-4 py-3 text-sm">{{ $card->carat_weight }} ct</td>
                        <td class="px-4 py-3 text-sm">{{ $card->clarity }}</td>
                        <td class="px-4 py-3 text-sm">{{ $card->color }}</td>
                        <td class="px-4 py-3 text-sm">{{ $card->cut }}</td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.products.edit', $card->id) }}">
                                    <a href="{{ route('admin.products.edit', $card->id) }}">
                                        <x-secondary-button type="button">
                                            {{ __('Edit') }}
                                        </x-secondary-button>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $card->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this certificate?')">
                                            Delete
                                        </x-danger-button>
                                    </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-3 text-center text-gray-500">No certificates found.</td>
                    </tr>
                @endforelse
            </x-table>

        </div>
    </div>
</x-app-layout>
