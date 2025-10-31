<x-guest-layout title="Forgot Password">
  <div class="flex h-screen flex-col md:flex-row">
    <!-- Left Image Section -->
    <div class="relative w-full md:w-1/2 overflow-hidden">
      <img
        src="{{ asset('assets/img/login.jpeg') }}"
        class="h-full w-full object-cover dark:hidden"
        alt="Office"
      />
      <img
        src="{{ asset('assets/img/login-office-dark.jpeg') }}"
        class="hidden h-full w-full object-cover dark:block"
        alt="Office"
      />
      <div
        class="absolute inset-0 bg-gradient-to-tr from-purple-700/60 via-indigo-600/50 to-transparent backdrop-blur-sm transition-all duration-500"
      ></div>
      <div
        class="absolute bottom-10 left-10 max-w-sm text-white drop-shadow-lg md:max-w-md"
      >
        <h2 class="mb-2 text-4xl font-extrabold tracking-tight">
          Reset Your Password 🔐
        </h2>
        <p class="text-sm leading-relaxed text-gray-100/90">
          Don’t worry! We’ll send a password reset link to your email.
        </p>
      </div>
    </div>

    <!-- Right Form Section -->
    <div
      class="flex w-full items-center justify-center bg-white/70 dark:bg-gray-900/80 backdrop-blur-xl md:w-1/2 p-6 sm:p-10"
    >
      <div
        class="w-full max-w-md rounded-2xl border border-gray-200/50 dark:border-gray-700/50 bg-white/60 dark:bg-gray-800/60 p-8 shadow-2xl backdrop-blur-lg transition-all duration-300 hover:shadow-purple-200/50 dark:hover:shadow-purple-900/40"
      >
        <div class="mb-8 text-center">
          <h1
            class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight"
          >
            Forgot Password?
          </h1>
          <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Enter your registered email to receive a reset link.
          </p>
        </div>

        <!-- Status Message -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Forgot Password Form -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
          @csrf

          <!-- Email -->
          <div>
            <label
              class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300"
              >Email</label
            >
            <input
              name="email"
              type="email"
              required
              value="{{ old('email') }}"
              class="w-full rounded-lg border border-gray-300/70 bg-white/80 px-4 py-2 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-transparent focus:ring-2 focus:ring-purple-500 dark:border-gray-700 dark:bg-gray-800/80 dark:text-gray-100 dark:placeholder-gray-500"
              placeholder="you@example.com"
            />
            @error('email')
              <span class="text-xs text-red-600 dark:text-red-400"
                >{{ $message }}</span
              >
            @enderror
          </div>

          <!-- Submit Button -->
          <button
            type="submit"
            class="mt-6 w-full rounded-lg bg-gradient-to-r from-purple-600 to-indigo-500 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:scale-[1.02] hover:from-purple-700 hover:to-indigo-600 focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-800"
          >
            Send Reset Link
          </button>
        </form>

        <!-- Back to Login -->
        <div class="mt-6 text-left text-sm text-gray-600 dark:text-gray-400">
          <a
            href="{{ route('login') }}"
            class="text-purple-600 hover:underline dark:text-purple-400"
          >
            ← Back to login
          </a>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
