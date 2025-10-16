<x-guest-layout title="Login">
  <div class="flex flex-col overflow-y-auto md:flex-row">
    <div class="h-32 md:h-auto md:w-1/2">
      <img aria-hidden="true" class="object-cover w-full h-full dark:hidden"
           src="{{ asset('assets/img/login.jpeg') }}" alt="Office" />
      <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
           src="{{ asset('assets/img/login-office-dark.jpeg') }}" alt="Office" />
    </div>
    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
      <div class="w-full">
        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Login</h1>

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Email</span>
            <input name="email" type="email" required
                   class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                   focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                   dark:text-gray-300 form-input" placeholder="example@mail.com" />
          </label>

          <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Password</span>
            <input name="password" type="password" required
                   class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                   focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                   dark:text-gray-300 form-input" placeholder="Password" />
          </label>

          <button type="submit"
                  class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center
                         text-white transition-colors duration-150 bg-purple-600 border border-transparent
                         rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Log in
          </button>
        </form>

        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
          <a href="{{ route('password.request') }}" class="text-purple-600 hover:underline">
            Forgot your password?
          </a>
        </p>

        {{-- <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          <a href="{{ route('register') }}" class="text-purple-600 hover:underline">
            Create account
          </a>
        </p> --}}
      </div>
    </div>
  </div>
</x-guest-layout>
