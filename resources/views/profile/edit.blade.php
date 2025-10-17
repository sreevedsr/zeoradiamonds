<x-app-layout>
    @slot('title', 'Zeeyame-Profile')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Profile
    </h2>

    {{-- <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8"> --}}
        <!-- Update Profile Information -->
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete User Account -->
        <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
</x-app-layout>
