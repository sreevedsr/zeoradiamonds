<x-app-layout>
    @slot('title', 'Zeeyame - Profile')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Profile
    </h2>

    <div class="space-y-8">
        <!-- Update Profile Information -->
        <div class="mb-4 p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="mb-4 p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete User Account -->
        <div class="mb-4 p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

        <!-- Logout Section -->
        <div
            class="mb-4  p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex flex-col items-left justify-between">
            <div class="mb-2">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Logout</h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    You can securely log out of your account below.
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-primary-button onclick="event.preventDefault(); this.closest('form').submit();"
                    class="bg-red-600 hover:bg-red-700 text-white flex items-center gap-2 justify-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    Log Out
                </x-primary-button>

            </form>
        </div>
    </div>
</x-app-layout>
