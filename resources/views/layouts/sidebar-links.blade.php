<li class="relative px-6 py-3">
                    <span
                        class="{{ request()->routeIs('dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
                        aria-hidden="true"></span>
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} inline-flex w-full items-start text-sm font-semibold transition-colors duration-150">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="ml-2">Dashboard</span>
                    </a>
                </li>

                @can('view-merchants')
                    <li class="relative px-6 py-3" x-data="{
                        openMerchants: {{ request()->routeIs('admin.merchants.*') ? 'true' : 'false' }},
                        height: 0,
                        setMeasured() {
                            this.height = this.$refs.panel ? this.$refs.panel.scrollHeight : 0;
                        },
                        toggleMerchants() {
                            if (!this.openMerchants) {
                                // Opening animation
                                this.setMeasured();
                                this.openMerchants = true;
                            } else {
                                // Closing animation
                                if (this.$refs.panel) {
                                    this.height = this.$refs.panel.scrollHeight;
                                    this.$nextTick(() => {
                                        this.height = 0;
                                        this.openMerchants = false;
                                    });
                                } else {
                                    this.height = 0;
                                    this.openMerchants = false;
                                }
                            }
                        }
                    }" x-init="$nextTick(() => {
                        if (openMerchants) setMeasured();
                        window.addEventListener('resize', () => {
                            if (openMerchants) setMeasured();
                        });
                    })">
                        <!-- Main Menu Button -->
                        <button @click="toggleMerchants" type="button"
                            class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
                            :aria-expanded="openMerchants.toString()">
                            <span
                                class="{{ request()->routeIs('admin.merchants.*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
                                aria-hidden="true"></span>

                            <!-- Icon -->
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M19 21V15M16 18H22M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z">
                                </path>
                            </svg>

                            <!-- Label -->
                            <span
                                class="{{ request()->routeIs('admin.merchants.*')
                                    ? 'text-gray-800 dark:text-gray-200'
                                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} ml-2 flex-1 text-left">
                                Merchants
                            </span>

                            <!-- Dropdown Arrow -->
                            <svg class="ml-auto h-4 w-4 transform-gpu transition-transform duration-300 ease-in-out"
                                :class="openMerchants ? 'rotate-180' : 'rotate-0'" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <ul x-ref="panel" :style="`height: ${height}px`"
                            @transitionend="if (openMerchants) height = 'auto'"
                            class="mt-2 space-y-2 overflow-hidden px-4 transition-all duration-300 ease-in-out">
                            <li>
                                <a href="{{ route('admin.merchants.create') }}"
                                    class="{{ request()->routeIs('admin.merchants.create')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    Add Merchant
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.merchants.index') }}"
                                    class="{{ request()->routeIs('admin.merchants.index')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    View Merchants
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('view-customers')
                    <li class="relative px-6 py-3" x-data="{
                        openCustomers: {{ request()->routeIs('merchant.customers.*') ? 'true' : 'false' }},
                        height: 0,
                        setMeasured() {
                            this.height = this.$refs.panel ? this.$refs.panel.scrollHeight : 0;
                        },
                        toggleCustomers() {
                            if (!this.openCustomers) {
                                // Opening
                                this.setMeasured();
                                this.openCustomers = true;
                            } else {
                                // Closing
                                if (this.$refs.panel) {
                                    this.height = this.$refs.panel.scrollHeight;
                                    this.$nextTick(() => {
                                        this.height = 0;
                                        this.openCustomers = false;
                                    });
                                } else {
                                    this.height = 0;
                                    this.openCustomers = false;
                                }
                            }
                        }
                    }" x-init="$nextTick(() => {
                        if (openCustomers) setMeasured();
                        window.addEventListener('resize', () => {
                            if (openCustomers) setMeasured();
                        });
                    })">
                        <span
                            class="{{ request()->routeIs('merchant.customers.*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true">
                        </span>

                        <!-- Main Menu Button -->
                        <button @click="toggleCustomers" type="button"
                            class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
                            :aria-expanded="openCustomers.toString()">
                            <!-- Icon -->
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M19 21V15M16 18H22M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z">
                                </path>
                            </svg>

                            <!-- Label -->
                            <span
                                class="{{ request()->routeIs('merchant.customers.*')
                                    ? 'text-gray-800 dark:text-gray-200'
                                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} ml-2 flex-1 text-left">
                                Customers
                            </span>

                            <!-- Arrow -->
                            <svg class="ml-auto h-4 w-4 transform-gpu transition-transform duration-300 ease-in-out"
                                :class="openCustomers ? 'rotate-180' : 'rotate-0'" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                                    clip-rule="evenodd">
                                </path>
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <ul x-ref="panel" :style="`height: ${height}px`"
                            @transitionend="if (openCustomers) height = 'auto'"
                            class="mt-2 space-y-2 overflow-hidden px-4 transition-all duration-300 ease-in-out">
                            <li>
                                <a href="{{ route('merchant.customers.create') }}"
                                    class="{{ request()->routeIs('merchant.customers.create')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    Add Customer
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('merchant.customers.index') }}"
                                    class="{{ request()->routeIs('merchant.customers.index')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    View Customers
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('view-suppliers')
                    <li class="relative px-6 py-3" x-data="{
                        openSuppliers: {{ request()->routeIs('admin.suppliers.*') ? 'true' : 'false' }},
                        height: 0,
                        setMeasured() {
                            this.height = this.$refs.panel ? this.$refs.panel.scrollHeight : 0;
                        },
                        toggleSuppliers() {
                            if (!this.openSuppliers) {
                                this.setMeasured();
                                this.openSuppliers = true;
                            } else {
                                if (this.$refs.panel) {
                                    this.height = this.$refs.panel.scrollHeight;
                                    this.$nextTick(() => {
                                        this.height = 0;
                                        this.openSuppliers = false;
                                    });
                                } else {
                                    this.height = 0;
                                    this.openSuppliers = false;
                                }
                            }
                        }
                    }" x-init="$nextTick(() => {
                        if (openSuppliers) setMeasured();
                        window.addEventListener('resize', () => {
                            if (openSuppliers) setMeasured();
                        });
                    })">

                        <!-- Highlight Bar -->
                        <span
                            class="{{ request()->routeIs('admin.suppliers.*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>

                        <!-- Main Menu Button -->
                        <button @click="toggleSuppliers" type="button"
                            class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
                            :aria-expanded="openSuppliers.toString()">

                            <!-- Icon -->
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 13V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v6M9 21h6M12 17v4M3 13h18"></path>
                            </svg>

                            <!-- Label -->
                            <span
                                class="{{ request()->routeIs('admin.suppliers.*')
                                    ? 'text-gray-800 dark:text-gray-200'
                                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} ml-2 flex-1 text-left">
                                Suppliers
                            </span>

                            <!-- Arrow -->
                            <svg class="ml-auto h-4 w-4 transform-gpu transition-transform duration-300 ease-in-out"
                                :class="openSuppliers ? 'rotate-180' : 'rotate-0'" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                                    clip-rule="evenodd">
                                </path>
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <ul x-ref="panel" :style="`height: ${height}px`"
                            @transitionend="if (openSuppliers) height = 'auto'"
                            class="mt-2 space-y-2 overflow-hidden px-4 transition-all duration-300 ease-in-out">

                            <li>
                                <a href="{{ route('admin.suppliers.create') }}"
                                    class="{{ request()->routeIs('admin.suppliers.create')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    Register Supplier
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.suppliers.index') }}"
                                    class="{{ request()->routeIs('admin.suppliers.index')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    View Suppliers
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan

                @can('edit-cards')
                    <li class="relative px-6 py-3" x-data="{
                        openCards: {{ request()->routeIs('admin.products.*') ? 'true' : 'false' }},
                        height: 0,
                        setup() {
                            this.setMeasured = () => {
                                this.height = this.$refs.cardsPanel ? this.$refs.cardsPanel.scrollHeight : 0
                            }
                        }
                    }" x-init="$nextTick(() => {
                        setup();
                        if (openCards) setMeasured();
                        window.addEventListener('resize', () => { if (openCards) setMeasured(); });
                    })"
                        x-on:destroy.window="window.removeEventListener('resize', () => {})">

                        <!-- Active indicator -->
                        <span
                            class="{{ request()->routeIs('admin.products.*')
                                ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                                : '' }}"
                            aria-hidden="true">
                        </span>

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
                            class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
                            :aria-expanded="openCards.toString()">

                            <!-- Icon -->
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>

                            <span
                                class="{{ request()->routeIs('admin.products.*')
                                    ? 'text-gray-800 dark:text-gray-200'
                                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} ml-2 flex-1 text-left">
                                Products
                            </span>

                            <!-- Rotating arrow -->
                            <svg class="ml-auto h-4 w-4 transform transition-transform duration-300 ease-in-out"
                                :class="{ 'rotate-180': openCards }" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293
                                                           a1 1 0 1 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4
                                                           a1 1 0 0 1 0-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <ul x-ref="cardsPanel" :style="`height: ${height}px`"
                            @transitionend="if (openCards) height = 'auto'"
                            class="mt-2 space-y-2 overflow-hidden px-4 transition-all duration-300 ease-in-out">

                            <li>
                                <a href="{{ route('admin.products.register') }}"
                                    class="{{ request()->routeIs('admin.products.register')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    Register Product
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.products.create') }}"
                                    class="{{ request()->routeIs('admin.products.create')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    Add Card
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.products.index') }}"
                                    class="{{ request()->routeIs('admin.products.index')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    View products
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.products.assign') }}"
                                    class="{{ request()->routeIs('admin.products.assign')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    Assign products
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.products.requests') }}"
                                    class="{{ request()->routeIs('admin.products.requests')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    View Card Requests
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('view-rates')
                    <li class="relative px-6 py-3">
                        <!-- Highlight Bar -->
                        <span
                            class="{{ request()->routeIs('admin.rates.*') ? 'absolute inset-y-0 left-0 w-1 bg-yellow-500 rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true">
                        </span>

                        <!-- Single Menu Button -->
                        <a href="{{ route('admin.rates.index') }}"
                            class="flex items-center text-sm font-semibold transition-colors duration-150
        {{ request()->routeIs('admin.rates.*')
            ? 'text-gray-800 dark:text-gray-200'
            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }}">

                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined">
                                <path d="M12 16v5" />
                                <path d="M16 14v7" />
                                <path d="M20 10v11" />
                                <path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15" />
                                <path d="M4 18v3" />
                                <path d="M8 14v7" />
                            </svg>

                            <!-- Label -->
                            <span class="ml-3">Gold & Diamond Rates</span>
                        </a>
                    </li>
                @endcan

                @can('view-cards')
                    <li class="relative px-6 py-3" x-data="{
                        openCards: {{ request()->routeIs('merchant.cards.*') ? 'true' : 'false' }},
                        height: 0,
                        toggleCards() {
                            if (!this.openCards) {
                                this.height = this.$refs.cardsPanel ? this.$refs.cardsPanel.scrollHeight : 0;
                                this.openCards = true;
                            } else {
                                if (this.$refs.cardsPanel) {
                                    this.height = this.$refs.cardsPanel.scrollHeight;
                                    this.$nextTick(() => {
                                        this.height = 0;
                                        this.openCards = false;
                                    });
                                } else {
                                    this.height = 0;
                                    this.openCards = false;
                                }
                            }
                        },
                        setMeasured() {
                            this.height = this.$refs.cardsPanel ? this.$refs.cardsPanel.scrollHeight : 0;
                        }
                    }" x-init="$nextTick(() => {
                        if (openCards) setMeasured();
                        window.addEventListener('resize', () => {
                            if (openCards) setMeasured();
                        });
                    })"
                        x-on:destroy.window="window.removeEventListener('resize', () => {})">

                        <!-- Active Highlight -->
                        <span
                            class="{{ request()->routeIs('merchant.cards.*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>

                        <!-- Main Menu Button -->
                        <button @click="toggleCards" type="button"
                            class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
                            :aria-expanded="openCards.toString()">

                            <!-- Icon -->
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>

                            <span
                                class="{{ request()->routeIs('merchant.cards.*')
                                    ? 'text-gray-800 dark:text-gray-200'
                                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} ml-2 flex-1 text-left">
                                Cards
                            </span>

                            <!-- Rotating Arrow -->
                            <svg class="ml-auto h-4 w-4 rotate-0 transform transition-transform duration-300 ease-in-out"
                                :class="{ 'rotate-180': openCards }" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 1 0-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <ul x-ref="cardsPanel" :style="`height: ${height}px`"
                            @transitionend="if (openCards) { height = 'auto' }"
                            class="mt-2 space-y-2 overflow-hidden px-4 transition-all duration-300 ease-in-out">

                            <li>
                                <a href="{{ route('merchant.cards.assign') }}"
                                    class="{{ request()->routeIs('merchant.cards.assign')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    Assign Cards
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('merchant.cards.index') }}"
                                    class="{{ request()->routeIs('merchant.cards.index')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    View Cards
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan

                @can('view-market')
                    <li class="relative px-6 py-3" x-data="{
                        openCards: {{ request()->routeIs('merchant.marketplace.*') ? 'true' : 'false' }},
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
                        <span
                            class="{{ request()->routeIs('merchant.marketplace.*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>

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
                            class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
                            :aria-expanded="openCards.toString()">

                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-shopping-bag-icon lucide-shopping-bag">
                                <path d="M16 10a4 4 0 0 1-8 0" />
                                <path d="M3.103 6.034h17.794" />
                                <path
                                    d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z" />
                            </svg>

                            <span
                                class="{{ request()->routeIs('merchant.marketplace.*')
                                    ? 'text-gray-800 dark:text-gray-200'
                                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} ml-2 flex-1 text-left">MarketPlace</span>

                            <!-- Rotating Arrow -->
                            <svg class="ml-auto h-4 w-4 rotate-0 transform transition-transform duration-300 ease-in-out"
                                :class="{ 'rotate-180': openCards }" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <ul x-ref="cardsPanel" :style="`height: ${height}px`"
                            @transitionend="if (openCards) { height = 'auto' }"
                            class="mt-2 space-y-2 overflow-hidden px-4 transition-all duration-300 ease-in-out">

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
                                <a href="{{ route('merchant.marketplace.request') }}"
                                    class="{{ request()->routeIs('merchant.marketplace.request')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    Request Cards
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('merchant.marketplace.view') }}"
                                    class="{{ request()->routeIs('merchant.marketplace.view')
                                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200' }} block rounded-md px-2 py-1 text-sm font-medium">
                                    View Requests
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan
