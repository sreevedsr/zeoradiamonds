<ul class="mt-6">
    <li class="relative px-6 py-3">
        <span
            class="<?php echo e(request()->routeIs('dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : ''); ?>"
            aria-hidden="true"></span>
        <a href="<?php echo e(route('dashboard')); ?>"
            class="<?php echo e(request()->routeIs('dashboard') ? 'text-gray-800 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?> inline-flex w-full items-start text-sm font-semibold transition-colors duration-150">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            <span class="ml-2 transition-all duration-200 origin-left"
                :class="isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                Dashboard
            </span> </a>
    </li>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-merchants')): ?>
        <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('admin.merchants.*') ? 'true' : 'false'); ?>)">

            <span
                class="<?php echo e(request()->routeIs('admin.merchants.*')
                    ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                    : ''); ?>"
                aria-hidden="true"></span>

            <button @click="toggle" type="button"
                class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
                :aria-expanded="open.toString()">

                <!-- Icon -->
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M12 15.5H7.5C6.1 15.5 5.4 15.5 4.84 15.67C3.56 16.06 2.56 17.06 2.17 18.34C2 18.9 2 19.6 2 21M19 21V15M16 18H22M14.5 7.5C14.5 9.98 12.48 12 10 12C7.51 12 5.5 9.98 5.5 7.5C5.5 5.01 7.51 3 10 3C12.48 3 14.5 5.01 14.5 7.5Z">
                    </path>
                </svg>

                <!-- Label -->
                <span
                    class="<?php echo e(request()->routeIs('admin.merchants.*')
                        ? 'text-gray-800 dark:text-gray-200'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                ml-2 flex-1 text-left transition-all duration-200 origin-left"
                    :class="isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                    Merchants
                </span>

                <!-- Dropdown Arrow (hidden when sidebar collapsed) -->
                <svg class="ml-auto h-4 w-4 transform transition-all duration-300 ease-in-out"
                    :class="[open ? 'rotate-180' : 'rotate-0', isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' :
                        'opacity-100 w-auto'
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
                    <a href="<?php echo e(route('admin.merchants.create')); ?>"
                        class="<?php echo e(request()->routeIs('admin.merchants.create')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

            block rounded-md px-2 py-1 text-sm font-medium">
                        Add Merchant
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.merchants.index')); ?>"
                        class="<?php echo e(request()->routeIs('admin.merchants.index')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

            block rounded-md px-2 py-1 text-sm font-medium">
                        View Merchants
                    </a>
                </li>
            </ul>

        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-customers')): ?>
        <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('merchant.customers.*') ? 'true' : 'false'); ?>)">

            <!-- Highlight bar -->
            <span
                class="<?php echo e(request()->routeIs('merchant.customers.*')
                    ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                    : ''); ?>"
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
                    class="<?php echo e(request()->routeIs('merchant.customers.*')
                        ? 'text-gray-800 dark:text-gray-200'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

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
                    <a href="<?php echo e(route('merchant.customers.create')); ?>"
                        class="<?php echo e(request()->routeIs('merchant.customers.create')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                    block rounded-md px-2 py-1 text-sm font-medium">
                        Add Customer
                    </a>
                </li>

                <li>
                    <a href="<?php echo e(route('merchant.customers.index')); ?>"
                        class="<?php echo e(request()->routeIs('merchant.customers.index')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                    block rounded-md px-2 py-1 text-sm font-medium">
                        View Customers
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-suppliers')): ?>
        <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('admin.suppliers.*') ? 'true' : 'false'); ?>)">

            <!-- Highlight Bar -->
            <span
                class="<?php echo e(request()->routeIs('admin.suppliers.*')
                    ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                    : ''); ?>"
                aria-hidden="true"></span>

            <!-- Main Menu Button -->
            <button @click="toggle" type="button"
                class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
                :aria-expanded="open.toString()">

                <!-- Icon -->
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 13V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v6M9 21h6M12 17v4M3 13h18"></path>
                </svg>

                <!-- Label -->
                <span
                    class="<?php echo e(request()->routeIs('admin.suppliers.*')
                        ? 'text-gray-800 dark:text-gray-200'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

            ml-2 flex-1 text-left transition-all duration-200 origin-left"
                    :class="isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                    Suppliers
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

            <!-- Submenu -->
            <ul x-ref="panel" :style="`height: ${height}px`" @transitionend="if (open) height = 'auto'"
                class="mt-2 space-y-2 overflow-hidden px-4 transition-all duration-300 ease-in-out"
                :class="isSidebarCollapsed ? 'hidden' : 'block'">

                <li>
                    <a href="<?php echo e(route('admin.suppliers.create')); ?>"
                        class="<?php echo e(request()->routeIs('admin.suppliers.create')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                        Register Supplier
                    </a>
                </li>

                <li>
                    <a href="<?php echo e(route('admin.suppliers.index')); ?>"
                        class="<?php echo e(request()->routeIs('admin.suppliers.index')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                        View Suppliers
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-cards')): ?>
        <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('admin.products.*') ? 'true' : 'false'); ?>)">

            <!-- Active Bar -->
            <span
                class="<?php echo e(request()->routeIs('admin.products.*')
                    ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                    : ''); ?>"
                aria-hidden="true"></span>

            <!-- Button -->
            <button @click="toggle" type="button"
                class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
                :aria-expanded="open.toString()">

                <!-- Icon -->
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>

                <!-- Label -->
                <span
                    class="<?php echo e(request()->routeIs('admin.products.*')
                        ? 'text-gray-800 dark:text-gray-200'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

            ml-2 flex-1 text-left transition-all duration-200 origin-left"
                    :class="isSidebarCollapsed ? 'opacity-0 w-0 overflow-hidden' : 'opacity-100 w-auto'">
                    Products
                </span>

                <!-- Dropdown Arrow -->
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
                    <a href="<?php echo e(route('admin.products.register')); ?>"
                        class="<?php echo e(request()->routeIs('admin.products.register')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                        Register Product
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.products.create')); ?>"
                        class="<?php echo e(request()->routeIs('admin.products.create')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                        Add Purchase Details
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.products.index')); ?>"
                        class="<?php echo e(request()->routeIs('admin.products.index')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                        View Products
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.products.assign')); ?>"
                        class="<?php echo e(request()->routeIs('admin.products.assign')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                        Assign Products
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.products.requests')); ?>"
                        class="<?php echo e(request()->routeIs('admin.products.requests')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                        View Card Requests
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-rates')): ?>
        <li class="relative px-6 py-3">
            <!-- Highlight Bar -->
            <span
                class="<?php echo e(request()->routeIs('admin.rates.*')
                    ? 'absolute inset-y-0 left-0 w-1 bg-yellow-500 rounded-tr-lg rounded-br-lg'
                    : ''); ?>"
                aria-hidden="true"></span>

            <!-- Single Menu Link -->
            <a href="<?php echo e(route('admin.rates.index')); ?>"
                class="<?php echo e(request()->routeIs('admin.rates.*')
                    ? 'text-gray-800 dark:text-gray-200'
                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

            inline-flex w-full items-start text-sm font-semibold transition-colors duration-150">

                <!-- Icon -->
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 16v5" />
                    <path d="M16 14v7" />
                    <path d="M20 10v11" />
                    <path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15" />
                    <path d="M4 18v3" />
                    <path d="M8 14v7" />
                </svg>

                <!-- Label (Hidden when collapsed) -->
                <span class="ml-2" :class="isSidebarCollapsed ? 'hidden' : 'block'">
                    Gold & Diamond Rates
                </span>
            </a>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-staff')): ?>
        <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('admin.staff.*') ? 'true' : 'false'); ?>)">

            <!-- Active Bar -->
            <span
                class="<?php echo e(request()->routeIs('admin.staff.*')
                    ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                    : ''); ?>"
                aria-hidden="true"></span>

            <!-- Menu Button -->
            <button @click="toggle" type="button"
                class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
                :aria-expanded="open.toString()">

                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-id-card-lanyard-icon lucide-id-card-lanyard h-5 w-5 shrink-0">
                    <path d="M13.5 8h-3" />
                    <path d="m15 2-1 2h3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h3" />
                    <path d="M16.899 22A5 5 0 0 0 7.1 22" />
                    <path d="m9 2 3 6" />
                    <circle cx="12" cy="15" r="3" />
                </svg>

                <!-- Label (completely hidden when sidebar collapsed) -->
                <span
                    class="<?php echo e(request()->routeIs('admin.staff.*')
                        ? 'text-gray-800 dark:text-gray-200'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                ml-2 flex-1 text-left transition-all duration-200 origin-left"
                    :class="isSidebarCollapsed ? 'hidden' : 'block'">
                    Staff
                </span>

                <!-- Dropdown Arrow (hidden when sidebar collapsed) -->
                <svg class="ml-auto h-4 w-4 transform transition-transform duration-300 ease-in-out"
                    :class="[open ? 'rotate-180' : 'rotate-0', isSidebarCollapsed ? 'hidden' : 'block']"
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
                    <a href="<?php echo e(route('admin.staff.create')); ?>"
                        class="<?php echo e(request()->routeIs('admin.staff.create')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                    block rounded-md px-2 py-1 text-sm font-medium">
                        Register Staff
                    </a>
                </li>

                <li>
                    <a href="<?php echo e(route('admin.staff.index')); ?>"
                        class="<?php echo e(request()->routeIs('admin.staff.index')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                    block rounded-md px-2 py-1 text-sm font-medium">
                        View Staff
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-cards')): ?>
        <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('merchant.cards.*') ? 'true' : 'false'); ?>)">

            <!-- Active Highlight -->
            <span
                class="<?php echo e(request()->routeIs('merchant.cards.*')
                    ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                    : ''); ?>"
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
                    class="<?php echo e(request()->routeIs('merchant.cards.*')
                        ? 'text-gray-800 dark:text-gray-200'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

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
                    <a href="<?php echo e(route('merchant.cards.assign')); ?>"
                        class="<?php echo e(request()->routeIs('merchant.cards.assign')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                        Assign Cards
                    </a>
                </li>

                <li>
                    <a href="<?php echo e(route('merchant.cards.index')); ?>"
                        class="<?php echo e(request()->routeIs('merchant.cards.index')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                        View Cards
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-market')): ?>
        <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('merchant.marketplace.*') ? 'true' : 'false'); ?>)">

            <!-- Active indicator -->
            <span
                class="<?php echo e(request()->routeIs('merchant.marketplace.*')
                    ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                    : ''); ?>"
                aria-hidden="true"></span>

            <!-- Main Button -->
            <button @click="toggle" type="button"
                class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
                :aria-expanded="open.toString()">

                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-shopping-bag">
                    <path d="M16 10a4 4 0 0 1-8 0" />
                    <path d="M3.103 6.034h17.794" />
                    <path
                        d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z" />
                </svg>

                <!-- Label -->
                <span
                    class="<?php echo e(request()->routeIs('merchant.marketplace.*')
                        ? 'text-gray-800 dark:text-gray-200'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

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
                    <a href="<?php echo e(route('merchant.marketplace.request')); ?>"
                        class="<?php echo e(request()->routeIs('merchant.marketplace.request')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                        Request Cards
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('merchant.marketplace.view')); ?>"
                        class="<?php echo e(request()->routeIs('merchant.marketplace.view')
                            ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                        View Requests
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>

</ul>
<?php /**PATH C:\xampp\htdocs\Zeeyame\resources\views/layouts/sidebar/links.blade.php ENDPATH**/ ?>