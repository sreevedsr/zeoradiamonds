<x-guest-layout title="Forgot Password">
    <div class="relative flex h-screen items-center justify-center overflow-hidden bg-gray-900">
        <!-- Background -->
        <img src="{{ asset('assets/img/login.jpeg') }}" class="absolute inset-0 h-full w-full object-cover dark:hidden"
            alt="Office" />
        <img src="{{ asset('assets/img/login-office-dark.jpeg') }}"
            class="absolute inset-0 hidden h-full w-full object-cover dark:block" alt="Office (Dark)" />

        <!-- Gradient Overlay -->
        <div
            class="absolute inset-0 bg-gradient-to-tr from-purple-800/60 via-indigo-700/50 to-transparent backdrop-blur-sm">
        </div>

        <!-- Forgot Password Card -->
        <div
            class="relative z-10 w-full max-w-md rounded-2xl border border-gray-200/50 dark:border-gray-700/50 bg-white/70 dark:bg-gray-900/80 p-8 shadow-2xl backdrop-blur-lg mx-4 overflow-hidden">
            <!-- Subtle Glow -->
            <div
                class="absolute inset-0 rounded-2xl bg-gradient-to-tr from-purple-500/10 via-transparent to-indigo-500/10 animate-pulse-slow pointer-events-none">
            </div>

            <!-- Content -->
            <div class="relative z-10 text-center">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">
                    Forgot Password? 🔐
                </h1>
                <p class="mt-2 mb-6 text-sm text-gray-600 dark:text-gray-400">
                    Enter your registered email to receive a password reset link.
                </p>

                <!-- Status Message -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Forgot Password Form -->
                <form method="POST" action="{{ route('password.email') }}" class="space-y-6 text-left">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email
                        </label>
                        <input name="email" type="email" required value="{{ old('email') }}"
                            class="w-full rounded-lg border border-gray-300/70 bg-white/80 px-4 py-2 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-transparent focus:ring-2 focus:ring-purple-500 dark:border-gray-700 dark:bg-gray-800/80 dark:text-gray-100 dark:placeholder-gray-500"
                            placeholder="you@example.com" />
                        @error('email')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="mt-6 w-full rounded-lg bg-gradient-to-r from-purple-600 to-indigo-500 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:scale-[1.03] hover:from-purple-700 hover:to-indigo-600 focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-800">
                        Send Reset Link
                    </button>
                </form>

                <!-- Back to Login -->
                <div class="mt-6 text-sm  text-gray-600 dark:text-gray-400">
                    <a href="{{ route('login') }}" class="text-purple-600 hover:underline dark:text-purple-400">
                        ← Back to login
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
