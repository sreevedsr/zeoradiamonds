<x-app-layout>
    @slot('title', 'Suppliers')

    <div class="bg-white shadow dark:bg-gray-800 sm:rounded-lg" x-data="editModal()">
        <div class=" text-gray-900 dark:text-gray-100">

            <!-- Suppliers Table -->
            <x-table :headers="['#', 'Supplier Code', 'Name', 'Phone', 'State', 'GST No', 'Created At', 'Actions']" :from="$pagination['from'] ?? 1" :to="$pagination['to'] ?? 10" :total="$pagination['total'] ?? count($suppliers)" :pages="$pagination['pages'] ?? [1]"
                :current="$pagination['current'] ?? 1">
                @foreach ($suppliers as $index => $supplier)
                    <tr
                        class="text-gray-700 transition-colors hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm">{{ $supplier->supplier_code }}</td>
                        <td class="px-4 py-3 text-sm">{{ $supplier->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $supplier->phone }}</td>
                        <td class="px-4 py-3 text-sm">
                            {{ $supplier->state }} ({{ $supplier->state_code }})
                        </td>
                        <td class="px-4 py-3 text-sm">{{ $supplier->gst_no }}</td>
                        <td class="px-4 py-3 text-sm">
                            {{ $supplier->created_at->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center space-x-3">

                                <!-- JSON for this row -->
                                <script id="supplier-{{ $supplier->id }}" type="application/json">
                                    @json($supplier)
                                </script>

                                <!-- Edit Button -->
                                <x-secondary-button
                                    x-on:click="
                                        openFromJson(
                                            {{ $supplier->id }},
                                            'supplier',
                                            'edit-supplier',
                                            'edit-supplier-modal',
                                            '/admin/suppliers'
                                        )
                                    ">
                                    Edit
                                </x-secondary-button>

                                <!-- Delete Button -->
                                <x-danger-button type="button"
                                    x-on:click.prevent="
                                        $dispatch('open-modal', 'confirm-delete-modal');
                                        document.getElementById('deleteSupplierForm').action =
                                            '{{ route('admin.suppliers.destroy', $supplier->id) }}';
                                    ">
                                    Delete
                                </x-danger-button>
                            </div>
                        </td>
                    </tr>
                @endforeach

                <x-confirm-delete-modal name="confirm-delete-modal" :action="''" title="Confirm Deletion"
                    message="Are you sure you want to delete this supplier? This action cannot be undone." />
            </x-table>

            <!-- Edit Supplier Modal -->
            <x-modal name="edit-supplier-modal" focusable>
                <form method="POST" id="edit-supplierForm" class="p-6">
                    @csrf
                    @method('PUT')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Edit Supplier
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Update the supplier details below and click "Save Changes".
                    </p>

                    <div class="mt-4 space-y-4">
                        <div>
                            <x-input-label for="edit-supplier-supplier_code" value="Supplier Code" />
                            <x-text-input id="edit-supplier-supplier_code" name="supplier_code" type="text"
                                class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="edit-supplier-name" value="Name" />
                            <x-text-input id="edit-supplier-name" name="name" type="text"
                                class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="edit-supplier-phone" value="Phone Number" />
                            <x-text-input id="edit-supplier-phone" name="phone" type="text"
                                class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="edit-supplier-address" value="Address" />
                            <x-textarea id="edit-supplier-address" name="address" rows="2"
                                class="mt-1 block w-full"></x-textarea>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="edit-supplier-state" value="State" />
                                <x-text-input id="edit-supplier-state" name="state" type="text"
                                    class="mt-1 block w-full" required />
                            </div>

                            <div>
                                <x-input-label for="edit-supplier-state_code" value="State Code" />
                                <x-text-input id="edit-supplier-state_code" name="state_code" type="text"
                                    class="mt-1 block w-full" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="edit-supplier-gst_no" value="GST Number" />
                            <x-text-input id="edit-supplier-gst_no" name="gst_no" type="text"
                                class="mt-1 block w-full" required />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <x-secondary-button type="button" x-on:click="$dispatch('close')">
                            Cancel
                        </x-secondary-button>

                        <x-primary-button>
                            Save Changes
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>
