<x-guest-layout>
    <div class="flex flex-col md:flex-row max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <!-- Left image -->
        <div class="h-48 md:h-auto md:w-1/2">
            <img
                class="object-cover w-full h-full dark:hidden"
                src="{{ asset('assets/img/forgot-password-office.jpeg') }}"
                alt="Office"
            />
            <img
                class="hidden object-cover w-full h-full dark:block"
                src="{{ asset('assets/img/forgot-password-office-dark.jpeg') }}"
                alt="Office"
            />
        </div>

        <!-- Right form -->
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                    {{ __('Forgot password') }}
                </h1>

                <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input
                            id="email"
                            class="block mt-1 w-full form-input dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:shadow-outline-gray focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            placeholder="you@example.com"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <x-primary-button class="w-full px-4 py-2 bg-purple-600 hover:bg-purple-700">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </form>

                <p class="mt-4 text-center">
                    <a
                        href="{{ route('login') }}"
                        class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                    >
                        {{ __('Back to login') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
