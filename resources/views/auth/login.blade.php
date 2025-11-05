<x-guest-layout title="Login">
    <div
        x-data="{ show: false }"
        x-init="
            setTimeout(() => show = true, 150);
            window.addEventListener('beforeunload', () => show = false);
        "
        class="relative flex h-screen items-center justify-center overflow-hidden"
    >
        <!-- Background -->
        <img
            src='{{ asset('assets/img/login.jpeg') }}'
            class="absolute inset-0 h-full w-full object-cover transform transition-all duration-[2500ms] ease-out dark:hidden"
            alt="Office"
        />
        <img
            src='{{ asset('assets/img/login-office-dark.jpeg') }}'
            class="absolute inset-0 hidden h-full w-full object-cover transform transition-all duration-[2500ms] ease-out dark:block"
            alt="Office (Dark)"
        />

        <!-- Gradient Overlay -->
        <div
            class="absolute inset-0 bg-gradient-to-tr from-purple-800/60 via-indigo-700/50 to-transparent backdrop-blur-sm transition-opacity duration-[1500ms] ease-in-out">
        </div>

        <!-- Login Card -->
        <div
            x-show="show"
            x-transition:enter="transition-all ease-out duration-700 delay-200"
            x-transition:enter-start="opacity-0 translate-y-10 scale-90"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition-all ease-in duration-500"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-10 scale-95"
            class="relative z-10 w-full max-w-md rounded-2xl border border-gray-200/50 dark:border-gray-700/50 bg-white/70 dark:bg-gray-900/80 p-8 shadow-2xl backdrop-blur-lg mx-4 overflow-hidden"
        >
            <!-- Animated Glow -->
            <div
                class="absolute inset-0 rounded-2xl bg-gradient-to-tr from-purple-500/10 via-transparent to-indigo-500/10 animate-pulse-slow pointer-events-none">
            </div>

            <!-- Content -->
            <div class="relative z-10">
                <div
                    x-show="show"
                    x-transition:enter="transition-all duration-700 ease-out delay-300"
                    x-transition:enter-start="opacity-0 translate-y-3"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mb-8 text-center"
                >
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">
                        Zeora Diamonds💎
                    </h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Access your dashboard and manage everything with ease.
                    </p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div
                        x-show="show"
                        x-transition:enter="transition-all duration-700 ease-out delay-400"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                    >
                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email
                        </label>
                        <input name="email" type="email" required value="{{ old('email') }}"
                            class="w-full rounded-lg border border-gray-300/70 bg-white/80 px-4 py-2 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-transparent focus:ring-2 focus:ring-purple-500 dark:border-gray-700 dark:bg-gray-800/80 dark:text-gray-100 dark:placeholder-gray-500"
                            placeholder="you@example.com" />
                        @error('email')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div x-data="{ showPassword: false }"
                        x-show="show"
                        x-transition:enter="transition-all duration-700 ease-out delay-500"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="relative">
                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Password
                        </label>
                        <input name="password" :type="showPassword ? 'text' : 'password'" required
                            class="w-full rounded-lg border border-gray-300/70 bg-white/80 px-4 py-2 pr-10 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-transparent focus:ring-2 focus:ring-purple-500 dark:border-gray-700 dark:bg-gray-800/80 dark:text-gray-100 dark:placeholder-gray-500"
                            placeholder="••••••••" />
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-3 top-8 text-gray-500 hover:text-purple-500 dark:text-gray-400">
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-eye-off">
                                <path
                                    d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49" />
                                <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
                                <path
                                    d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143" />
                                <path d="m2 2 20 20" />
                            </svg>
                            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                                <path
                                    d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <div
                        x-show="show"
                        x-transition:enter="transition-all duration-700 ease-out delay-600"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                    >
                        <button type="submit"
                            class="mt-6 w-full rounded-lg bg-gradient-to-r from-purple-600 to-indigo-500 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:scale-[1.03] hover:from-purple-700 hover:to-indigo-600 focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-800">
                            Log In
                        </button>
                    </div>
                </form>

                <!-- Links -->
                <div class="mt-6 flex justify-between text-sm text-gray-600 dark:text-gray-400">
                    <a href="{{ route('password.request') }}" class="text-purple-600 hover:underline dark:text-purple-400">
                        Forgot password?
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom slow pulse animation -->
    <style>
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }
    </style>
</x-guest-layout>
