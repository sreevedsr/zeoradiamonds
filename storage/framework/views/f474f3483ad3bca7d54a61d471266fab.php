<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
    <div class="container flex items-center justify-between h-full px-6 text-purple-600 dark:text-purple-300">
        <!-- Sidebar toggle button (works for both mobile and desktop) -->
        <button class="p-2 rounded-md focus:outline-none focus:shadow-outline-purple" @click="toggleSidebar"
            aria-label="Toggle sidebar">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>

        <!-- Page title -->
        <h1 class="text-xl font-semibold text-gray-700 dark:text-gray-200 ml-4 truncate">
            Dashboard
        </h1>

        <!-- Optional right section -->
        <div class="flex items-center space-x-6">
            <!-- Search bar (optional) -->
            <div class="hidden md:flex justify-center flex-1">
                <div class="relative w-full max-w-xs focus-within:text-purple-500">
                    <div class="absolute inset-y-0 flex items-center pl-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input
                        class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:outline-none focus:shadow-outline-purple form-input"
                        type="text" placeholder="Search" aria-label="Search" />
                </div>
            </div>

            <!-- Notifications -->
            <button class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                @click="toggleNotificationsMenu">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 2a6 6 0 00-6 6v3.586L3.293 13.293A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                    </path>
                </svg>
                <span aria-hidden="true"
                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
            </button>
        </div>
    </div>
</header>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>