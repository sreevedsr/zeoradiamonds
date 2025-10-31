<x-app-layout>
    @slot('title', 'Zeeyame - Diamond Certificates')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        View Diamond Certificates
    </h2>

    <!-- Certificate Table Section -->
    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-7xl mx-auto text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Certificates Table -->
            <x-table :headers="['#', 'Certificate ID', 'Diamond Type', 'Carat Weight', 'Clarity', 'Color', 'Cut', 'Actions']" :from="1" :to="$cards->count()" :total="$cards->count()" :pages="[1]"
                :current="1">
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
                                <a href="{{ route('admin.cards.edit', $card->id) }}">
                                    <a href="{{ route('admin.cards.edit', $card->id) }}">
                                        <x-secondary-button type="button">
                                            {{ __('Edit') }}
                                        </x-secondary-button>
                                    </a>
                                    <form action="{{ route('admin.cards.destroy', $card->id) }}" method="POST"
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
