<x-app-layout>
    @slot('title', 'Diamond Certificates')

    <div class="bg-white px-6 py-2 shadow dark:bg-gray-800 rounded-lg">
        <div class="mx-auto max-w-7xl text-gray-900 dark:text-gray-100">
            <x-table :headers="['#', 'Certificate ID', 'Diamond Shape', 'Carat Weight', 'Clarity', 'Color', 'Cut', 'Actions']" :from="1" :to="$cards->count()" :total="$cards->count()" :pages="[1]"
                :current="1" :route="route('admin.products.index')" :searchQuery="request('search', '')">
                @foreach ($cards as $index => $card)
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
                                    <x-secondary-button type="button">
                                        {{ __('Edit') }}
                                    </x-secondary-button>
                                </a>

                                <!-- Delete Button -->
                                <x-danger-button type="button" x-data
                                    x-on:click.prevent="
                                        $dispatch('open-modal', 'confirm-delete-modal');
                                        document.getElementById('deleteForm').action = '{{ route('admin.products.destroy', $card->id) }}';
                                    ">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-table>

            <!-- Single Delete Confirmation Modal (Global) -->
            <x-confirm-delete-modal action="#" title="Confirm Deletion"
                message="Are you sure you want to delete this certificate? This action cannot be undone." />
        </div>
    </div>
</x-app-layout>
