<header
    class="sticky top-0 z-20 pt-7 pb-4 bg-white dark:bg-gray-900
           border-b border-gray-200 dark:border-none
           dark:shadow-lg dark:shadow-gray-900/20
           transition-all duration-300">

    <div class="flex items-center justify-between h-full px-6 text-purple-600 dark:text-purple-300">

        <!-- Left Section: Sidebar Toggle + Page Title -->
        <div class="flex items-center space-x-3">
            <!-- Desktop Sidebar Toggle Button -->
            <button class="hidden md:block p-2 rounded-md focus:outline-none transition-transform duration-300"
                @click="toggleSidebar" aria-label="Toggle desktop sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-panel-right rotate-180">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M15 3v18" />
                </svg>
            </button>

            <!-- Mobile Sidebar Toggle Button -->
            <button class="md:hidden p-2 rounded-md focus:outline-none transition-transform duration-300"
                @click="toggleMobileSidebar" aria-label="Toggle mobile sidebar">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <h1
                class="text-xl sm:text-2xl md:text-3xl font-semibold text-gray-800 dark:text-gray-100  max-w-[60vw] sm:max-w-none">
                {{ $title ?? 'Dashboard' }}
            </h1>
        </div>

        <!-- Right Section -->
        {{-- <div class="flex items-center space-x-6">
            <!-- Search (hidden on mobile) -->
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
                        class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-transparent border-0 rounded-md dark:placeholder-gray-500 dark:text-gray-200 focus:outline-none focus:ring-0"
                        type="text" placeholder="Search" aria-label="Search" />
                </div>
            </div>

            <!-- Notifications -->
            <button class="relative align-middle rounded-md focus:outline-none" @click="toggleNotificationsMenu">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 2a6 6 0 00-6 6v3.586L3.293 13.293A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                    </path>
                </svg>
                <span aria-hidden="true"
                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
            </button>
        </div> --}}
    </div>
</header>
