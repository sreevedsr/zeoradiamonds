<x-app-layout>
    @slot('title', 'Zeeyame - Customers')

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        View Customers
    </h2>

    <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-7xl mx-auto text-gray-900 dark:text-gray-100">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Customers Table -->
            <x-table
                :headers="['#', 'Customer Name', 'Email', 'Phone', 'City', 'State', 'Created At', 'Actions']"
                :from="$customers->firstItem()"
                :to="$customers->lastItem()"
                :total="$customers->total()"
                :pages="$customers->getUrlRange(1, $customers->lastPage())"
                :current="$customers->currentPage()"
                :route="route('merchant.customers.index')"
                searchPlaceholder="Search customers..."
            >
                @foreach ($customers as $index => $customer)
                    <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-4 py-3 text-sm">{{ $customers->firstItem() + $index }}</td>

                        <td class="px-4 py-3 text-sm">
                            <p>{{ $customer->name }}</p>
                        </td>

                        <td class="px-4 py-3 text-sm">{{ $customer->email }}</td>
                        <td class="px-4 py-3 text-sm">{{ $customer->phone }}</td>
                        <td class="px-4 py-3 text-sm">{{ $customer->city ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm">{{ $customer->state ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm">{{ $customer->created_at->format('d M Y') }}</td>

                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center space-x-3">
                                <!-- Edit Button -->
                                <x-secondary-button
                                    type="button"
                                    x-data
                                    x-on:click.prevent="
                                        $dispatch('open-modal', 'edit-customer-modal');
                                        setTimeout(() => {
                                            document.getElementById('edit_name').value = '{{ $customer->name }}';
                                            document.getElementById('edit_email').value = '{{ $customer->email }}';
                                            document.getElementById('edit_phone').value = '{{ $customer->phone }}';
                                            document.getElementById('edit_city').value = '{{ $customer->city }}';
                                            document.getElementById('edit_state').value = '{{ $customer->state }}';
                                            document.getElementById('edit_address').value = '{{ $customer->address }}';
                                            {{-- document.getElementById('editCustomerForm').action = '{{ route('merchant.customers.update', $customer->id) }}'; --}}
                                        }, 100);
                                    ">
                                    {{ __('Edit') }}
                                </x-secondary-button>

                                <!-- Delete Button -->
                                {{-- <form action="{{ route('merchant.customers.destroy', $customer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button onclick="return confirm('Are you sure you want to delete this customer?')">
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                </form> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-table>

            <!-- Edit Customer Modal -->
            <x-modal name="edit-customer-modal" focusable>
                <form method="POST" id="editCustomerForm" class="p-6">
                    @csrf
                    @method('PUT')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Edit Customer') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Update customer details below. Please make sure all required fields are filled correctly.') }}
                    </p>

                    <div class="mt-4 space-y-4">
                        <div>
                            <x-input-label for="edit_name" value="{{ __('Full Name') }}" />
                            <x-text-input id="edit_name" name="name" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter full name') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_email" value="{{ __('Email Address') }}" />
                            <x-text-input id="edit_email" name="email" type="email" class="mt-1 block w-full"
                                placeholder="{{ __('example@email.com') }}" required />
                        </div>

                        <div>
                            <x-input-label for="edit_phone" value="{{ __('Phone Number') }}" />
                            <x-text-input id="edit_phone" name="phone" type="text" class="mt-1 block w-full"
                                placeholder="{{ __('Enter phone number') }}" required />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="edit_city" value="{{ __('City') }}" />
                                <x-text-input id="edit_city" name="city" type="text" class="mt-1 block w-full"
                                    placeholder="{{ __('Enter city') }}" />
                            </div>

                            <div>
                                <x-input-label for="edit_state" value="{{ __('State') }}" />
                                <x-text-input id="edit_state" name="state" type="text" class="mt-1 block w-full"
                                    placeholder="{{ __('Enter state') }}" />
                            </div>
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

                        <x-primary-button>
                            {{ __('Save Changes') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>

        </div>
    </div>
</x-app-layout>
