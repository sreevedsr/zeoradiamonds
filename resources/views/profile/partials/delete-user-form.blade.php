<section class="space-y-6">
    <!-- Section Header -->
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Trigger Button -->
    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="dark:bg-red-600 dark:hover:bg-red-500 dark:text-white px-4 py-2 rounded-md">
        {{ __('Delete Account') }}
    </x-danger-button>

    <!-- Modal -->
    @push('modals')
        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}"
                class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md mx-auto">
                @csrf
                @method('delete')

                <!-- Modal Header -->
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <!-- Password Input -->
                <div class="mt-4">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <x-text-input id="password" name="password" type="password" placeholder="{{ __('Password') }}"
                        class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400"
                        required />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-600 dark:text-red-400" />
                </div>

                <!-- Modal Actions -->
                <div class="mt-6 flex justify-end gap-3">
                    <x-secondary-button x-on:click="$dispatch('close')"
                        class="dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 px-4 py-2 rounded-md">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="dark:bg-red-600 dark:hover:bg-red-500 dark:text-white px-4 py-2 rounded-md">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endpush
</section>
