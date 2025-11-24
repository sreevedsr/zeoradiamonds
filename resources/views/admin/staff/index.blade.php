<x-app-layout>
    @slot('title', 'Staff')

    <div class="bg-white p-4 shadow dark:bg-gray-800 sm:rounded-lg sm:px-8" x-data="editModal()">
        <div class="mx-auto text-gray-900 dark:text-gray-100">

            <x-table
                :headers="['#', 'Staff Code', 'Name', 'Phone', 'Address', 'Created At', 'Actions']"
                :from="$pagination['from'] ?? 1"
                :to="$pagination['to'] ?? 10"
                :total="$pagination['total'] ?? count($staff)"
                :pages="$pagination['pages'] ?? [1]"
                :current="$pagination['current'] ?? 1"
            >
                @foreach ($staff as $index => $s)
                    <tr class="text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm">{{ $s->staff_code }}</td>
                        <td class="px-4 py-3 text-sm">{{ $s->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $s->phone }}</td>
                        <td class="px-4 py-3 text-sm">{{ $s->address }}</td>
                        <td class="px-4 py-3 text-sm">{{ $s->created_at->format('d M Y') }}</td>

                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center space-x-3">

                                <!-- JSON DATA -->
                                <script id="staff-{{ $s->id }}" type="application/json">
                                    @json($s)
                                </script>

                                <!-- Edit -->
                                <x-secondary-button
                                    x-on:click="
                                        openFromJson(
                                            {{ $s->id }},
                                            'staff',
                                            'edit-staff',
                                            'edit-staff-modal',
                                            '/admin/staff'
                                        )
                                    "
                                >
                                    Edit
                                </x-secondary-button>

                                <!-- Delete -->
                                <x-danger-button
                                    x-on:click.prevent="
                                        $dispatch('open-modal', 'confirm-delete-modal');
                                        document.getElementById('deleteStaffForm').action =
                                            '{{ route('admin.staff.destroy', $s->id) }}';
                                    "
                                >
                                    Delete
                                </x-danger-button>

                            </div>
                        </td>
                    </tr>
                @endforeach

                <x-confirm-delete-modal
                    name="confirm-delete-modal"
                    :action="''"
                    title="Confirm Staff Deletion"
                    message="Are you sure you want to delete this staff member?"
                />

            </x-table>

            <!-- Edit Staff Modal -->
            <x-modal name="edit-staff-modal" focusable>
                <form id="edit-staffForm" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Edit Staff
                    </h2>

                    <div class="mt-4 space-y-4">
                        <div>
                            <x-input-label for="edit-staff-staff_code" value="Staff Code" />
                            <x-text-input id="edit-staff-staff_code" name="staff_code" class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="edit-staff-name" value="Name" />
                            <x-text-input id="edit-staff-name" name="name" class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="edit-staff-phone" value="Phone" />
                            <x-text-input id="edit-staff-phone" name="phone" class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="edit-staff-address" value="Address" />
                            <x-textarea id="edit-staff-address" name="address" rows="2" class="mt-1 block w-full"></x-textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                        <x-primary-button>Save Changes</x-primary-button>
                    </div>

                </form>
            </x-modal>

        </div>
    </div>

</x-app-layout>
