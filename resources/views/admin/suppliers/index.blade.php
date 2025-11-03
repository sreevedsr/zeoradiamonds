<x-app-layout>
    @slot('title', 'Zeeyame - Suppliers')

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        View Suppliers
    </h2>

    <div class="bg-white p-6 shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
        <div class="mx-auto max-w-7xl text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 rounded bg-green-200 p-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Suppliers Table -->
            <x-table
                :headers="['#', 'Supplier Code', 'Name', 'Phone', 'State', 'GST No', 'Created At', 'Actions']"
                :from="$pagination['from'] ?? 1"
                :to="$pagination['to'] ?? 10"
                :total="$pagination['total'] ?? count($suppliers)"
                :pages="$pagination['pages'] ?? [1]"
                :current="$pagination['current'] ?? 1"
            >
                @foreach ($suppliers as $index => $supplier)
                    <tr class="text-gray-700 transition-colors hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>

                        <td class="px-4 py-3 text-sm">{{ $supplier->supplier_code }}</td>
                        <td class="px-4 py-3 text-sm">{{ $supplier->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $supplier->phone }}</td>
                        <td class="px-4 py-3 text-sm">{{ $supplier->state }} ({{ $supplier->state_code }})</td>
                        <td class="px-4 py-3 text-sm">{{ $supplier->gst_no }}</td>
                        <td class="px-4 py-3 text-sm">{{ $supplier->created_at->format('d M Y') }}</td>

                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center space-x-3">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.suppliers.edit', $supplier->id) }}">
                                    <x-secondary-button type="button" x-data
                                        x-on:click.prevent="
                                            $dispatch('open-modal', 'edit-supplier-modal');
                                            setTimeout(() => {
                                                document.getElementById('edit_supplier_code').value = '{{ $supplier->supplier_code }}';
                                                document.getElementById('edit_name').value = '{{ $supplier->name }}';
                                                document.getElementById('edit_address').value = '{{ $supplier->address }}';
                                                document.getElementById('edit_phone_no').value = '{{ $supplier->phone }}';
                                                document.getElementById('edit_state_code').value = '{{ $supplier->state_code }}';
                                                document.getElementById('edit_state').value = '{{ $supplier->state }}';
                                                document.getElementById('edit_gst_no').value = '{{ $supplier->gst_no }}';
                                                document.getElementById('editSupplierForm').action = '{{ route('admin.suppliers.update', $supplier->id) }}';
                                            }, 100);
                                        ">
                                        {{ __('Edit') }}
                                    </x-secondary-button>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="button" x-data
                                        x-on:click.prevent="
                                            $dispatch('open-modal', 'confirm-delete-modal');
                                            document.getElementById('deleteSupplierForm').action = '{{ route('admin.suppliers.destroy', $supplier->id) }}';
                                        ">
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-table>

            <!-- Edit Supplier Modal -->
            <x-modal name="edit-supplier-modal" focusable>
                <form method="POST" id="editSupplierForm" class="p-6">
                    @csrf
                    @method('PUT')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Edit Supplier') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Update the supplier details below and click "Save Changes".') }}
                    </p>

                    <div class="mt-4 space-y-4">
                        <div>
                            <x-input-label for="edit_supplier_code" value="{{ __('Supplier Code') }}" />
                            <x-text-input id="edit_supplier_code" name="supplier_code" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter supplier code') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_name" value="{{ __('Name') }}" />
                            <x-text-input id="edit_name" name="name" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter supplier name') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_phone_no" value="{{ __('Phone Number') }}" />
                            <x-text-input id="edit_phone_no" name="phone" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter phone number') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_address" value="{{ __('Address') }}" />
                            <x-textarea id="edit_address" name="address" rows="2" class="mt-1 block w-full"
                                placeholder="{{ __('Enter supplier address') }}"></x-textarea>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="edit_state" value="{{ __('State') }}" />
                                <x-text-input id="edit_state" name="state" type="text" class="mt-1 block w-full"
                                    placeholder="{{ __('Enter state name') }}" required />
                            </div>

                            <div>
                                <x-input-label for="edit_state_code" value="{{ __('State Code') }}" />
                                <x-text-input id="edit_state_code" name="state_code" type="text" class="mt-1 block w-full"
                                    placeholder="{{ __('Enter state code') }}" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="edit_gst_no" value="{{ __('GST Number') }}" />
                            <x-text-input id="edit_gst_no" name="gst_no" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter GST number') }}" required />
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
                <form method="POST" id="deleteSupplierForm" class="p-6">
                    @csrf
                    @method('DELETE')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Confirm Deletion') }}
                    </h2>

                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Are you sure you want to delete this supplier? This action cannot be undone.') }}
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
