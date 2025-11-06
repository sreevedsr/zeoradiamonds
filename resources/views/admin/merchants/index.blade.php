<x-app-layout>
    @slot('title', 'Merchants')

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        View Merchants
    </h2>

    <div class="bg-white p-6 shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
        <div class="mx-auto  text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 rounded bg-green-200 p-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Merchants Table -->
            <x-table :headers="[
                '#',
                'Merchant Code',
                'Name',
                'Email',
                'Phone',
                'State Code',
                'GST No',
                'Created At',
                'Actions',
            ]" :from="$pagination['from'] ?? 1" :to="$pagination['to'] ?? 10" :total="$pagination['total'] ?? count($merchants)" :pages="$pagination['pages'] ?? [1]"
                :current="$pagination['current'] ?? 1">

                @foreach ($merchants as $index => $merchant)
                    <tr
                        class="text-gray-700 transition-colors hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm font-medium">{{ $merchant->merchant_code ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm">
                            <p>{{ $merchant->name }}</p>
                        </td>
                        <td class="px-4 py-3 text-sm">{{ $merchant->email }}</td>
                        <td class="px-4 py-3 text-sm">{{ $merchant->phone ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm">{{ $merchant->state_code ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm">{{ $merchant->gst_no ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm">{{ $merchant->created_at?->format('d M Y') ?? '—' }}</td>

                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center space-x-3">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.merchants.edit', $merchant->id) }}">
                                    <x-secondary-button type="button" x-data
                                        x-on:click.prevent="$dispatch('open-modal', 'edit-merchant-modal');
                                    setTimeout(() => {
                                    document.getElementById('edit_merchant_code').value = '{{ $merchant->merchant_code }}';
                                    document.getElementById('edit_name').value = '{{ $merchant->name }}';
                                    document.getElementById('edit_email').value = '{{ $merchant->email }}';
                                    document.getElementById('edit_phone').value = '{{ $merchant->phone }}';
                                    document.getElementById('edit_address').value = '{{ $merchant->address }}';
                                    document.getElementById('edit_state_code').value = '{{ $merchant->state_code }}';
                                    document.getElementById('edit_state').value = '{{ $merchant->state }}';
                                    document.getElementById('edit_gst_no').value = '{{ $merchant->gst_no }}';
                                    document.getElementById('editMerchantForm').action = '{{ route('admin.merchants.update', $merchant->id) }}';}, 100);">
                                        {{ __('Edit') }}
                                    </x-secondary-button>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.merchants.destroy', $merchant->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="button" x-data
                                        x-on:click.prevent="
                                $dispatch('open-modal', 'confirm-delete-modal');
                                document.getElementById('deleteMerchantForm').action = '{{ route('admin.merchants.destroy', $merchant->id) }}';
                            ">
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
                        {{ __('Update the merchant details below and click "Save Changes".') }}
                    </p>

                    <div class="mt-4 space-y-4">

                        <div>
                            <x-input-label for="edit_merchant_code" value="{{ __('Merchant Code') }}" />
                            <x-text-input id="edit_merchant_code" name="merchant_code" type="text"
                                class="mt-1 block w-full" placeholder="{{ __('Enter merchant code') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_name" value="{{ __('Merchant Name') }}" />
                            <x-text-input id="edit_name" name="name" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter merchant name') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_email" value="{{ __('Email') }}" />
                            <x-text-input id="edit_email" name="email" type="email" class="mt-1 block w-full"
                                placeholder="{{ __('Enter email address') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_phone" value="{{ __('Phone No.') }}" />
                            <x-text-input id="edit_phone" name="phone" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter phone number') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_address" value="{{ __('Address') }}" />
                            <x-textarea id="edit_address" name="address" rows="2" class="mt-1 block w-full"
                                placeholder="{{ __('Enter full address') }}" required></x-textarea>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="edit_state_code" value="{{ __('State Code') }}" />
                                <x-text-input id="edit_state_code" name="state_code" type="text"
                                    class="mt-1 block w-full" placeholder="{{ __('Enter or select state code') }}"
                                    required />
                            </div>

                            <div>
                                <x-input-label for="edit_state" value="{{ __('State') }}" />
                                <x-text-input id="edit_state" name="state" type="text" class="mt-1 block w-full"
                                    placeholder="{{ __('Enter or select state') }}" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="edit_gst_no" value="{{ __('GST No.') }}" />
                            <x-text-input id="edit_gst_no" name="gst_no" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter GST number') }}" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <x-secondary-button type="button" x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button>
                            {{ __('Save Changes') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>



            <!-- Delete Confirmation Modal -->
            <x-modal name="confirm-delete-modal" focusable>
                <form method="POST" id="deleteMerchantForm" class="p-6">
                    @csrf
                    @method('DELETE')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Confirm Deletion') }}
                    </h2>

                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Are you sure you want to delete this merchant? This action cannot be undone.') }}
                    </p>

                    <div class="mt-6 flex justify-end space-x-3">
                        <x-secondary-button type="button" x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button>
                            {{ __('Yes, Delete') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>
