<x-guest-layout title="Login">
  <div class="relative flex h-screen items-center justify-center overflow-hidden">

    <!-- Fullscreen Background Image -->
    <img
      src="{{ asset('assets/img/login.jpeg') }}"
      class="absolute inset-0 h-full w-full object-cover dark:hidden"
      alt="Office"
    />
    <img
      src="{{ asset('assets/img/login-office-dark.jpeg') }}"
      class="absolute inset-0 hidden h-full w-full object-cover dark:block"
      alt="Office"
    />

    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-tr from-purple-800/60 via-indigo-700/50 to-transparent backdrop-blur-sm"></div>

    <!-- Centered Card -->
    <div
      class="relative z-10 w-full max-w-md rounded-2xl border border-gray-200/50 dark:border-gray-700/50 bg-white/70 dark:bg-gray-900/80 p-8 shadow-2xl backdrop-blur-lg transition-all duration-300 hover:shadow-purple-200/50 dark:hover:shadow-purple-900/40 mx-4"
    >
      <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">
          Zeeyame💎
        </h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
          Access your dashboard and manage everything with ease.
        </p>
      </div>

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
          <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
            Email
          </label>
          <input
            name="email"
            type="email"
            required
            value="{{ old('email') }}"
            class="w-full rounded-lg border border-gray-300/70 bg-white/80 px-4 py-2 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-transparent focus:ring-2 focus:ring-purple-500 dark:border-gray-700 dark:bg-gray-800/80 dark:text-gray-100 dark:placeholder-gray-500"
            placeholder="you@example.com"
          />
          @error('email')
            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
          @enderror
        </div>

        <!-- Password -->
        <div x-data="{ show: false }" class="relative">
          <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
            Password
          </label>
          <input
            name="password"
            :type="show ? 'text' : 'password'"
            required
            class="w-full rounded-lg border border-gray-300/70 bg-white/80 px-4 py-2 pr-10 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-transparent focus:ring-2 focus:ring-purple-500 dark:border-gray-700 dark:bg-gray-800/80 dark:text-gray-100 dark:placeholder-gray-500"
            placeholder="••••••••"
          />
          <button
            type="button"
            @click="show = !show"
            class="absolute right-3 top-9 text-gray-500 hover:text-purple-500 dark:text-gray-400"
          >
            <svg
              x-show="!show"
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="M3.98 8.223A10.477 10.477 0 0012 15.75a10.477 10.477 0 008.02-7.527M15 12a3 3 0 11-6 0 3 3 0 016 0z"
              />
            </svg>
            <svg
              x-show="show"
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="M13.875 18.825A10.477 10.477 0 0112 19.5a10.477 10.477 0 01-8.02-7.527M3.98 8.223L3 7.5M21 21l-2-2m-6-1.5A3 3 0 0112 12m0 0a3 3 0 013-3"
              />
            </svg>
          </button>
          @error('password')
            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
          @enderror
        </div>

        <!-- Submit -->
        <button
          type="submit"
          class="mt-6 w-full rounded-lg bg-gradient-to-r from-purple-600 to-indigo-500 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:scale-[1.02] hover:from-purple-700 hover:to-indigo-600 focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-800"
        >
          Log In
        </button>
      </form>

      <!-- Links -->
      <div class="mt-6 flex justify-between text-sm text-gray-600 dark:text-gray-400">
        <a
          href="{{ route('password.request') }}"
          class="text-purple-600 hover:underline dark:text-purple-400"
        >
          Forgot password?
        </a>
        {{-- Uncomment to enable registration --}}
        {{-- <a href="{{ route('register') }}" class="text-purple-600 hover:underline dark:text-purple-400">
            Create account
          </a> --}}
      </div>
    </div>
  </div>
</x-guest-layout>
