<x-app-layout>
    @slot('title', 'All Staff')

    <div class="bg-white p-4 shadow dark:bg-gray-800 sm:rounded-lg sm:px-8">
        <div class="mx-auto text-gray-900 dark:text-gray-100">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 p-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Staff Table -->
            <x-table
                :headers="['Code', 'Name', 'Phone No.', 'Address', 'Actions']"
                :from="$staff->firstItem()"
                :to="$staff->lastItem()"
                :total="$staff->total()"
                :pages="$staff->getUrlRange(1, $staff->lastPage())"
                :current="$staff->currentPage()"
                :route="route('admin.staff.index')"
                :filters="[]"
                searchPlaceholder="Search staff..."
            >
                @forelse ($staff as $s)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition duration-150">
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $s->code }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $s->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $s->phone_no }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $s->address }}</td>

                        <!-- Actions Column -->
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">
                            <div class="flex items-center space-x-3">

                                <!-- Edit Button -->
                                <x-secondary-button type="button" x-data
                                    x-on:click.prevent="
                                        $dispatch('open-modal', 'edit-staff-modal');
                                        setTimeout(() => {
                                            document.getElementById('edit_staff_code').value = '{{ $s->code }}';
                                            document.getElementById('edit_name').value = '{{ $s->name }}';
                                            document.getElementById('edit_phone_no').value = '{{ $s->phone_no }}';
                                            document.getElementById('edit_address').value = '{{ $s->address }}';
                                            document.getElementById('editStaffForm').action = '{{ route('admin.staff.update', $s->id) }}';
                                        }, 100);
                                    ">
                                    {{ __('Edit') }}
                                </x-secondary-button>

                                <!-- Delete Button -->
                                <x-danger-button type="button" x-data
                                    x-on:click.prevent="
                                        $dispatch('open-modal', 'confirm-delete-modal');
                                        document.getElementById('deleteForm').action = '{{ route('admin.staff.destroy', $s->id) }}';
                                    ">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center text-sm text-gray-500 dark:text-gray-400">
                            No staff records found.
                        </td>
                    </tr>
                @endforelse
            </x-table>

            <!-- ✅ Edit Staff Modal -->
            <x-modal name="edit-staff-modal" focusable>
                <form method="POST" id="editStaffForm" class="p-6">
                    @csrf
                    @method('PUT')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Edit Staff Details') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Update staff details below and click "Save Changes".') }}
                    </p>

                    <div class="mt-4 space-y-4">
                        <div>
                            <x-input-label for="edit_staff_code" value="{{ __('Staff Code') }}" />
                            <x-text-input id="edit_staff_code" name="code" type="text"
                                class="mt-1 block w-full" placeholder="{{ __('Enter staff code') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_name" value="{{ __('Name') }}" />
                            <x-text-input id="edit_name" name="name" type="text"
                                class="mt-1 block w-full" placeholder="{{ __('Enter name') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_phone_no" value="{{ __('Phone Number') }}" />
                            <x-text-input id="edit_phone_no" name="phone_no" type="text"
                                class="mt-1 block w-full" placeholder="{{ __('Enter phone number') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_address" value="{{ __('Address') }}" />
                            <x-textarea id="edit_address" name="address" rows="2"
                                class="mt-1 block w-full" placeholder="{{ __('Enter address') }}"></x-textarea>
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

            <!-- ✅ Delete Confirmation Modal -->
            <x-confirm-delete-modal
                action="#"
                title="Confirm Deletion"
                message="Are you sure you want to delete this staff record? This action cannot be undone."
            />
        </div>
    </div>
</x-app-layout>
