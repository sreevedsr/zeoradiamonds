<!-- Desktop Sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="flex flex-col justify-between h-full py-4 text-gray-500 dark:text-gray-400">
        <div>
            <!-- Logo -->
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                Zeeyame
            </a>
            @auth
                <div class="flex items-center mt-6 px-6">
                    <img class="w-8 h-8 rounded-full object-cover"
                        src="{{ Auth::user()->profile_photo_url ?? '/default-profile.png' }}" alt="{{ Auth::user()->name }}">

                    <div class="ml-4">
                        <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                    </div>

                </div>
            @endauth

            <!-- Navigation -->
            <ul class="mt-6">
                <li class="relative px-6 py-3">
                    <span
                        class="{{ request()->routeIs('dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
                        aria-hidden="true"></span>
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-start w-full text-sm font-semibold transition-colors duration-150
                       {{ request()->routeIs('dashboard') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="ml-2">Dashboard</span>
                    </a>
                </li>
                {{-- @can('view-merchants')
                    <li class="relative px-6 py-3" x-data="{ openMerchants: {{ request()->routeIs('admin.merchants.*') ? 'true' : 'false' }}, height: 0 }">
                        <!-- Main Menu Button -->
                        <button
                            @click="
            openMerchants = !openMerchants;
            if (openMerchants) {
                height = $refs.panel.scrollHeight
            } else {
                height = 0
            }
        "
                            type="button"
                            class="flex items-start w-full text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-150 rounded-md focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M19 21V15M16 18H22M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z">
                                </path>
                            </svg>

                            <span class="ml-2 flex-1 text-left">Merchants</span>
                            <svg class="w-4 h-4 ml-auto transition-transform duration-300"
                                :class="{ 'rotate-180': openMerchants }" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <ul x-ref="panel" :style="`height: ${height}px`"
                            class="mt-2 space-y-2 px-4 overflow-hidden transition-all duration-300 ease-in-out">
                            <li>
                                <a href="{{ route('admin.merchants.create') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                {{ request()->routeIs('admin.merchants.create') ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    Add Merchant
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.merchants.index') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                {{ request()->routeIs('admin.merchants.index') ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    View Merchants
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('merchants.request') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                {{ request()->routeIs('merchants.request') ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    View Requests
                                </a>
                            </li> --}}
                {{-- </ul> --}}
                {{-- </li> --}}
                {{-- @endcan  --}}
                @can('view-merchants')
                    <li class="relative px-6 py-3" x-data="{
                        openMerchants: {{ request()->routeIs('admin.merchants.*') ? 'true' : 'false' }},
                        height: 0,
                        setup() {
                            // helper to set measured height
                            this.setMeasured = () => { this.height = this.$refs.panel ? this.$refs.panel.scrollHeight : 0 }
                        }
                    }" x-init="$nextTick(() => { setup(); if (openMerchants) { setMeasured(); } window.addEventListener('resize', () => { if (openMerchants) setMeasured() }) })"
                        x-on:destroy.window="window.removeEventListener('resize', () => {})">
                        <!-- Main Menu Button -->
                        <button
                            @click="
      // toggle with nice animation:
      if (!openMerchants) {
        // opening: measure and set px height (animates from 0 -> measured)
        setMeasured();
        openMerchants = true;
      } else {
        // closing: set current measured height then force it to 0 to animate collapse
        // (helps when height had been 'auto')
        if ($refs.panel) {
          height = $refs.panel.scrollHeight;
          // wait a tick so browser registers starting height, then collapse
          $nextTick(()=> { height = 0; openMerchants = false })
        } else {
          height = 0; openMerchants = false
        }
      }
    "
                            type="button"
                            class="flex items-start w-full text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-150 rounded-md focus:outline-none"
                            :aria-expanded="openMerchants.toString()">
                            <!-- icon / label -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M19 21V15M16 18H22M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z">
                                </path>
                            </svg>

                            <span class="ml-2 flex-1 text-left">Merchants</span>
                            <svg class="w-4 h-4 ml-auto transform-gpu transition-transform duration-300 ease-in-out rotate-0"
                                :class="openMerchants ? 'rotate-180' : 'rotate-0'" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                                    clip-rule="evenodd">
                                </path>
                            </svg>


                        </button>

                        <!-- Submenu -->
                        <ul x-ref="panel" :style="`height: ${height}px`"
                            @transitionend="
      // after opening transition finish, if open -> make height 'auto' for flexible layout
      if (openMerchants) { height = 'auto' }
    "
                            class="mt-2 space-y-2 px-4 overflow-hidden transition-all duration-300 ease-in-out">
                            <li>
                                <a href="{{ route('admin.merchants.create') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
           {{ request()->routeIs('admin.merchants.create') ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    Add Merchant
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.merchants.index') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
           {{ request()->routeIs('admin.merchants.index') ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    View Merchants
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan


                @can('view-customers')
                    <li class="relative px-6 py-3" x-data="{
                        openCustomers: {{ request()->routeIs('customers.*') ? 'true' : 'false' }},
                        height: 0,
                        setup() {
                            this.setMeasured = () => { this.height = this.$refs.panel ? this.$refs.panel.scrollHeight : 0 }
                        }
                    }" x-init="$nextTick(() => {
                        setup();
                        if (openCustomers) setMeasured();
                        window.addEventListener('resize', () => { if (openCustomers) setMeasured() });
                    })"
                        x-on:destroy.window="window.removeEventListener('resize', () => {})">

                        <!-- Main Menu Button -->
                        <button
                            @click="
            if (!openCustomers) {
                setMeasured();
                openCustomers = true;
            } else {
                if ($refs.panel) {
                    height = $refs.panel.scrollHeight;
                    $nextTick(() => { height = 0; openCustomers = false });
                } else {
                    height = 0; openCustomers = false;
                }
            }
        "
                            type="button"
                            class="flex items-start w-full text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-150 rounded-md focus:outline-none"
                            :aria-expanded="openCustomers.toString()">

                            <!-- Icon -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M19 21V15M16 18H22M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z">
                                </path>
                            </svg>

                            <span class="ml-2 flex-1 text-left">Customers</span>

                            <!-- Rotating Arrow -->
                            <svg class="w-4 h-4 ml-auto transform transition-transform duration-300 ease-in-out rotate-0"
                                :class="{ 'rotate-180': openCustomers }" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <ul x-ref="panel" :style="`height: ${height}px`"
                            @transitionend="if (openCustomers) { height = 'auto' }"
                            class="mt-2 space-y-2 px-4 overflow-hidden transition-all duration-300 ease-in-out">

                            <li>
                                <a href="{{ route('customers.create') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                    {{ request()->routeIs('customers.create')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    Add Customer
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('customers.index') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                    {{ request()->routeIs('customers.index')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    View Customers
                                </a>
                            </li>

                            {{-- Uncomment if needed later
        <li>
            <a href="{{ route('customers.requests') }}"
                class="block px-2 py-1 text-sm font-medium rounded-md
                    {{ request()->routeIs('customers.requests')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                View Requests
            </a>
        </li>
        --}}
                        </ul>
                    </li>
                @endcan



                @can('edit-cards')
                    <li class="relative px-6 py-3" x-data="{
                        openCards: {{ request()->routeIs('admin.cards.*') ? 'true' : 'false' }},
                        height: 0,
                        setup() {
                            this.setMeasured = () => { this.height = this.$refs.cardsPanel ? this.$refs.cardsPanel.scrollHeight : 0 }
                        }
                    }" x-init="$nextTick(() => {
                        setup();
                        if (openCards) { setMeasured(); }
                        window.addEventListener('resize', () => { if (openCards) setMeasured(); });
                    })"
                        x-on:destroy.window="window.removeEventListener('resize', () => {})">

                        <!-- Main Menu Button -->
                        <button
                            @click="
            if (!openCards) {
                setMeasured();
                openCards = true;
            } else {
                if ($refs.cardsPanel) {
                    height = $refs.cardsPanel.scrollHeight;
                    $nextTick(() => { height = 0; openCards = false });
                } else {
                    height = 0; openCards = false;
                }
            }
        "
                            type="button"
                            class="flex items-start w-full text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-150 rounded-md focus:outline-none"
                            :aria-expanded="openCards.toString()">
                            <!-- Icon -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>

                            <span class="ml-2 flex-1 text-left">Cards</span>
                            <svg class="w-4 h-4 ml-auto transition-transform duration-300"
                                :class="{ 'rotate-180': openCards }" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 1 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <ul x-ref="cardsPanel" :style="`height: ${height}px`"
                            @transitionend="if (openCards) { height = 'auto' }"
                            class="mt-2 space-y-2 px-4 overflow-hidden transition-all duration-300 ease-in-out">

                            <li>
                                <a href="{{ route('admin.cards.create') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                {{ request()->routeIs('admin.cards.create') ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    Add Card
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.cards.index') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                {{ request()->routeIs('admin.cards.index') ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    View Cards
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.cards.requests') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                {{ request()->routeIs('admin.cards.requests') ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    View Card Requests
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('view-cards')
                    <li class="relative px-6 py-3" x-data="{
                        openCards: {{ request()->routeIs('merchant.cards.assign') || request()->routeIs('merchant.cards.index') ? 'true' : 'false' }},
                        height: 0,
                        setup() {
                            this.setMeasured = () => { this.height = this.$refs.cardsPanel ? this.$refs.cardsPanel.scrollHeight : 0 }
                        }
                    }" x-init="$nextTick(() => {
                        setup();
                        if (openCards) setMeasured();
                        window.addEventListener('resize', () => { if (openCards) setMeasured() });
                    })"
                        x-on:destroy.window="window.removeEventListener('resize', () => {})">

                        <!-- Main Menu Button -->
                        <button
                            @click="
            if (!openCards) {
                setMeasured();
                openCards = true;
            } else {
                if ($refs.cardsPanel) {
                    height = $refs.cardsPanel.scrollHeight;
                    $nextTick(() => { height = 0; openCards = false });
                } else {
                    height = 0; openCards = false;
                }
            }
        "
                            type="button"
                            class="flex items-start w-full text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-150 rounded-md focus:outline-none"
                            :aria-expanded="openCards.toString()">

                            <!-- Icon -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>

                            <span class="ml-2 flex-1 text-left">Cards</span>

                            <!-- Rotating Arrow -->
                            <svg class="w-4 h-4 ml-auto transform transition-transform duration-300 ease-in-out rotate-0"
                                :class="{ 'rotate-180': openCards }" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 1 0-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <ul x-ref="cardsPanel" :style="`height: ${height}px`"
                            @transitionend="if (openCards) { height = 'auto' }"
                            class="mt-2 space-y-2 px-4 overflow-hidden transition-all duration-300 ease-in-out">

                            <li>
                                <a href="{{ route('merchant.cards.assign') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                {{ request()->routeIs('merchant.cards.assign')
                    ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    Assign Cards
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('merchant.cards.index') }}"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                {{ request()->routeIs('merchant.cards.index')
                    ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    View Cards
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan

                @can('view-market')
                    <li class="relative px-6 py-3" x-data="{
                        openCards: {{ request()->is('request-cards') || request()->is('view-requests') ? 'true' : 'false' }},
                        height: 0,
                        setup() {
                            this.setMeasured = () => { this.height = this.$refs.cardsPanel ? this.$refs.cardsPanel.scrollHeight : 0 }
                        }
                    }" x-init="$nextTick(() => {
                        setup();
                        if (openCards) setMeasured();
                        window.addEventListener('resize', () => { if (openCards) setMeasured() });
                    })"
                        x-on:destroy.window="window.removeEventListener('resize', () => {})">

                        <!-- Main Menu Button -->
                        <button
                            @click="
            if (!openCards) {
                setMeasured();
                openCards = true;
            } else {
                if ($refs.cardsPanel) {
                    height = $refs.cardsPanel.scrollHeight;
                    $nextTick(() => { height = 0; openCards = false });
                } else {
                    height = 0; openCards = false;
                }
            }
        "
                            type="button"
                            class="flex items-start w-full text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-150 rounded-md focus:outline-none"
                            :aria-expanded="openCards.toString()">

                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag-icon lucide-shopping-bag"><path d="M16 10a4 4 0 0 1-8 0"/><path d="M3.103 6.034h17.794"/><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"/></svg>

                            <span class="ml-2 flex-1 text-left">MarketPlace</span>

                            <!-- Rotating Arrow -->
                            <svg class="w-4 h-4 ml-auto transform transition-transform duration-300 ease-in-out rotate-0"
                                :class="{ 'rotate-180': openCards }" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <ul x-ref="cardsPanel" :style="`height: ${height}px`"
                            @transitionend="if (openCards) { height = 'auto' }"
                            class="mt-2 space-y-2 px-4 overflow-hidden transition-all duration-300 ease-in-out">

                            {{-- Uncomment this if you add a route later
        <li>
            <a href="{{ route('cards.create') }}"
                class="block px-2 py-1 text-sm font-medium rounded-md
                {{ request()->routeIs('cards.create')
                    ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                Assign Card
            </a>
        </li>
        --}}

                            <li>
                                <a href="/request-cards"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                {{ request()->is('request-cards')
                    ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    Request Cards
                                </a>
                            </li>

                            <li>
                                <a href="/view-requests"
                                    class="block px-2 py-1 text-sm font-medium rounded-md
                {{ request()->is('view-requests')
                    ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                                    View Requests
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan

            </ul>

            {{-- @can('create-account')
            <div class="px-6 my-6">
                <button class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Create account
                    <span class="ml-2" aria-hidden="true">+</span>
                </button>
            </div>
            @endcan --}}
        </div>

        <!-- Profile & Settings at bottom -->
        <div class="px-6 mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
            <!-- Profile -->
            <a href="{{ route('profile.edit') }}"
                class="flex items-center px-2 py-2 text-xs font-medium text-gray-700 dark:text-gray-300 rounded-md
               transition-colors duration-150
               hover:bg-gray-100 hover:text-gray-900
               dark:hover:bg-black dark:hover:text-white">
                <svg class="w-5 h-5 mr-3 transition-colors duration-150" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Profile
            </a>

            <!-- Settings -->
            <a href="#"
                class="flex items-center px-2 py-2 mt-2 text-xs font-medium text-gray-700 dark:text-gray-300 rounded-md
               transition-colors duration-150
               hover:bg-gray-100 hover:text-gray-900
               dark:hover:bg-black dark:hover:text-white">
                <svg class="w-5 h-5 mr-3 transition-colors duration-150" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.325 4.317c.426-1.756 2.924-1.756
               3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94
               3.31.826 2.37 2.37a1.724 1.724 0 001.065
               2.572c1.756.426 1.756 2.924 0
               3.35a1.724 1.724 0 00-1.066
               2.573c.94 1.543-.826
               3.31-2.37 2.37a1.724 1.724 0
               00-2.572 1.065c-.426 1.756-2.924
               1.756-3.35 0a1.724 1.724 0
               00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724
               1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924
               0-3.35a1.724 1.724 0
               001.066-2.573c-.94-1.543.826-3.31
               2.37-2.37.996.608 2.296.07
               2.572-1.065z"></path>
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Settings
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center w-full px-2 py-2 mt-2 text-xs font-medium text-gray-700 dark:text-gray-300 rounded-md
                   transition-colors duration-150
                   hover:bg-gray-100 hover:text-gray-900
                   dark:hover:bg-black dark:hover:text-white">
                    <svg class="w-5 h-5 mr-3 transition-colors duration-150" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 16l-4-4m0 0l4-4m-4
                   4h14m-5 4v1a3 3 0 01-3
                   3H6a3 3 0 01-3-3V7a3 3
                   0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Log out
                </button>
            </form>
        </div>



    </div>
</aside>

<!-- Mobile Sidebar -->
<div x-show="isSideMenuOpen" x-transition.opacity class="fixed inset-0 z-10 bg-black bg-opacity-50 md:hidden"></div>

<aside class="fixed inset-y-0 z-20 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">

    <div class="flex flex-col justify-between py-4 text-gray-500 dark:text-gray-400 h-full">
        <div>
            <!-- Logo -->
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                Zeeyame
            </a>

            <!-- Navigation -->
            <ul class="mt-6">
                <li class="relative px-6 py-3">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-start w-full text-sm font-semibold transition-colors duration-150
                       {{ request()->routeIs('dashboard') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                        Dashboard
                    </a>
                </li>
            </ul>

            <ul>
                @can('view-forms')
                    <li class="relative px-6 py-3">
                        <a href="{{ route('forms.index') }}"
                            class="inline-flex items-start w-full text-sm font-semibold transition-colors duration-150
                       {{ request()->routeIs('forms.*') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            Forms
                        </a>
                    </li>
                @endcan

                @can('view-cards')
                    <li class="relative px-6 py-3">
                        <a href="{{ route('admin.cards.index') }}"
                            class="inline-flex items-start w-full text-sm font-semibold transition-colors duration-150
                       {{ request()->routeIs('cards.*') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            Cards
                        </a>
                    </li>
                @endcan
            </ul>

            {{-- @can('create-account')
                <div class="px-6 my-6">
                    <button
                        class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Create account
                        <span class="ml-2" aria-hidden="true">+</span>
                    </button>
                </div>
            @endcan --}}
        </div>

        <!-- Profile & Settings at bottom -->
        <div class="px-6 mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
            <a href="{{ route('profile.edit') }}"
                class="flex items-center px-2 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Profile
            </a>
            <a href="#"
                class="flex items-center px-2 py-2 mt-2 text-sm font-medium text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Settings
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center w-full px-2 py-2 mt-2 text-sm font-medium text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Log out
                </button>
            </form>
        </div>
    </div>
</aside>
