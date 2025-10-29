<x-app-layout>
    @slot('title', 'Zeeyame - Merchants')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        View Merchants
    </h2>

    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-7xl mx-auto text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Merchants Table -->
            <x-table
                :headers="['#', 'Owner Name', 'Business Name', 'Created At', 'Actions']"
                :from="$pagination['from'] ?? 1"
                :to="$pagination['to'] ?? 10"
                :total="$pagination['total'] ?? count($merchants)"
                :pages="$pagination['pages'] ?? [1]"
                :current="$pagination['current'] ?? 1"
            >
                @foreach ($merchants as $index => $merchant)
                    <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>

                        <td class="px-4 py-3 text-sm">
                            <p>{{ $merchant->name }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $merchant->email }}</p>
                        </td>

                        <td class="px-4 py-3 text-sm">{{ $merchant->business_name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $merchant->created_at->format('d M Y') }}</td>

                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center space-x-3">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.merchants.edit', $merchant->id) }}">
                                    <x-secondary-button
                                        type="button"
                                        x-data
                                        x-on:click.prevent="
                                            $dispatch('open-modal', 'edit-merchant-modal');
                                            setTimeout(() => {
                                                document.getElementById('edit_name').value = '{{ $merchant->name }}';
                                                document.getElementById('edit_business_name').value = '{{ $merchant->business_name }}';
                                                document.getElementById('edit_email').value = '{{ $merchant->email }}';
                                                document.getElementById('edit_phone').value = '{{ $merchant->phone }}';
                                                document.getElementById('edit_address').value = '{{ $merchant->address }}';
                                                document.getElementById('editMerchantForm').action = '{{ route('admin.merchants.update', $merchant->id) }}';
                                            }, 100);
                                        ">
                                        {{ __('Edit') }}
                                    </x-secondary-button>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.merchants.destroy', $merchant->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button onclick="return confirm('Are you sure you want to delete this merchant?')">
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-table>

            <!-- Edit Merchant Modal -->
            <x-modal name="edit-merchant-modal" focusable>
                <form method="POST" id="editMerchantForm" class="p-6">
                    @csrf
                    @method('PUT')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Edit Merchant') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Update the merchant details below. Please make sure all fields are filled correctly before saving changes.') }}
                    </p>

                    <div class="mt-4 space-y-4">
                        <div>
                            <x-input-label for="edit_name" value="{{ __('Name') }}" />
                            <x-text-input id="edit_name" name="name" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter merchant name') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_business_name" value="{{ __('Business Name') }}" />
                            <x-text-input id="edit_business_name" name="business_name" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter business name') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_email" value="{{ __('Email') }}" />
                            <x-text-input id="edit_email" name="email" type="email" class="mt-1 block w-full"
                                placeholder="{{ __('example@email.com') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_phone" value="{{ __('Phone') }}" />
                            <x-text-input id="edit_phone" name="phone" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter phone number') }}" required />
                        </div>

                        <div class="sm:col-span-2">
                            <x-input-label for="edit_address" value="{{ __('Address') }}" />
                            <x-textarea id="edit_address" name="address" rows="3" class="mt-1 block w-full"
                                placeholder="{{ __('Enter address') }}"></x-textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <x-secondary-button type="button" x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button >
                            {{ __('Save Changes') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>
