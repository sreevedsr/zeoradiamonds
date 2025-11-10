@can('view-customers')
    <li class="relative px-6 py-3" x-data="collapsibleMenu({{ request()->routeIs('merchant.customers.*') ? 'true' : 'false' }})">

        <!-- Highlight bar -->
        <span
            class="{{ request()->routeIs('merchant.customers.*')
                ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                : '' }}"
            aria-hidden="true"></span>

        <!-- Main Menu Button -->
        <button @click="toggle" type="button"
            class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
            :aria-expanded="open.toString()">

            <!-- Icon -->
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M19 21V15M16 18H22M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z">
                </path>
            </svg>

            <!-- Label -->
            <span
                class="{{ request()->routeIs('merchant.customers.*')
                    ? 'text-gray-800 dark:text-gray-200'
                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}
                ml-2 flex-1 text-left transition-all duration-200 origin-left"
                :class="isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                Customers
            </span>

            <!-- Dropdown Arrow (hidden when sidebar collapsed) -->
            <svg class="ml-auto h-4 w-4 transform transition-all duration-300 ease-in-out"
                :class="[open ? 'rotate-180' : 'rotate-0',
                    isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'
                ]"
                fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>

        <!-- Submenu (hidden when sidebar collapsed) -->
        <ul x-ref="panel" :style="`height: ${height}px`" @transitionend="if (open) height = 'auto'"
            class="mt-2 space-y-2 overflow-hidden px-4 transition-all duration-300 ease-in-out"
            :class="isSidebarCollapsed ? 'hidden' : 'block'">

            <li>
                <a href="{{ route('merchant.customers.create') }}"
                    class="{{ request()->routeIs('merchant.customers.create')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}
                    block rounded-md px-2 py-1 text-sm font-medium">
                    Add Customer
                </a>
            </li>

            <li>
                <a href="{{ route('merchant.customers.index') }}"
                    class="{{ request()->routeIs('merchant.customers.index')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}
                    block rounded-md px-2 py-1 text-sm font-medium">
                    View Customers
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('view-cards')
    <li class="relative px-6 py-3" x-data="collapsibleMenu({{ request()->routeIs('merchant.cards.*') ? 'true' : 'false' }})">

        <!-- Active Highlight -->
        <span
            class="{{ request()->routeIs('merchant.cards.*')
                ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                : '' }}"
            aria-hidden="true"></span>

        <!-- Main Menu Button -->
        <button @click="toggle" type="button"
            class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
            :aria-expanded="open.toString()">

            <!-- Icon -->
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                </path>
            </svg>

            <!-- Label -->
            <span
                class="{{ request()->routeIs('merchant.cards.*')
                    ? 'text-gray-800 dark:text-gray-200'
                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}
            ml-2 flex-1 text-left transition-all duration-200 origin-left"
                :class="isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                Cards
            </span>

            <!-- Arrow -->
            <svg class="ml-auto h-4 w-4 transform transition-all duration-300 ease-in-out"
                :class="[open ? 'rotate-180' : 'rotate-0',
                    isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'
                ]"
                fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>

        <!-- Submenu -->
        <ul x-ref="panel" :style="`height: ${height}px`" @transitionend="if (open) height = 'auto'"
            class="mt-2 space-y-2 overflow-hidden px-4 transition-all duration-300 ease-in-out"
            :class="isSidebarCollapsed ? 'hidden' : 'block'">

            <li>
                <a href="{{ route('merchant.cards.assign') }}"
                    class="{{ request()->routeIs('merchant.cards.assign')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}
                block rounded-md px-2 py-1 text-sm font-medium">
                    Assign Cards
                </a>
            </li>

            <li>
                <a href="{{ route('merchant.cards.index') }}"
                    class="{{ request()->routeIs('merchant.cards.index')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}
                block rounded-md px-2 py-1 text-sm font-medium">
                    View Cards
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('view-market')
    <li class="relative px-6 py-3" x-data="collapsibleMenu({{ request()->routeIs('merchant.marketplace.*') ? 'true' : 'false' }})">

        <!-- Active indicator -->
        <span
            class="{{ request()->routeIs('merchant.marketplace.*')
                ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                : '' }}"
            aria-hidden="true"></span>

        <!-- Main Button -->
        <button @click="toggle" type="button"
            class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
            :aria-expanded="open.toString()">

            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-shopping-bag">
                <path d="M16 10a4 4 0 0 1-8 0" />
                <path d="M3.103 6.034h17.794" />
                <path
                    d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z" />
            </svg>

            <!-- Label -->
            <span
                class="{{ request()->routeIs('merchant.marketplace.*')
                    ? 'text-gray-800 dark:text-gray-200'
                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}
            ml-2 flex-1 text-left transition-all duration-200 origin-left"
                :class="isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                Marketplace
            </span>

            <!-- Arrow -->
            <svg class="ml-auto h-4 w-4 transform transition-all duration-300 ease-in-out"
                :class="[open ? 'rotate-180' : 'rotate-0',
                    isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'
                ]"
                fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>

        <!-- Submenu -->
        <ul x-ref="panel" :style="`height: ${height}px`" @transitionend="if (open) height = 'auto'"
            class="mt-2 space-y-2 overflow-hidden px-4 transition-all duration-300 ease-in-out"
            :class="isSidebarCollapsed ? 'hidden' : 'block'">

            <li>
                <a href="{{ route('merchant.marketplace.request') }}"
                    class="{{ request()->routeIs('merchant.marketplace.request')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}
                block rounded-md px-2 py-1 text-sm font-medium">
                    Request Cards
                </a>
            </li>
            <li>
                <a href="{{ route('merchant.marketplace.view') }}"
                    class="{{ request()->routeIs('merchant.marketplace.view')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}
                block rounded-md px-2 py-1 text-sm font-medium">
                    View Requests
                </a>
            </li>
        </ul>
    </li>
@endcan
