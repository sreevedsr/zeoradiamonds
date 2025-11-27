<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-merchants')): ?>
    <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('admin.merchants.*') ? true : false); ?>)">

        <span
            class="<?php echo e(request()->routeIs('admin.merchants.*')
                ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                : ''); ?>"
            aria-hidden="true"></span>

        <button @click="toggle" type="button"
            class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500 transition-colors duration-150 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
            :aria-expanded="open.toString()">

            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-shopping-cart-icon lucide-shopping-cart shrink-0">
                <circle cx="8" cy="21" r="1" />
                <circle cx="19" cy="21" r="1" />
                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
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

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-suppliers')): ?>
    <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('admin.suppliers.*') ? true : false); ?>)">

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
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-users-icon lucide-users shrink-0">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <path d="M16 3.128a4 4 0 0 1 0 7.744" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <circle cx="9" cy="7" r="4" />
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

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-products')): ?>
    <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('admin.products.*') ? true : false); ?>)">

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
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-package-icon lucide-package shrink-0">
                <path
                    d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z" />
                <path d="M12 22V12" />
                <polyline points="3.29 7 12 12 20.71 7" />
                <path d="m7.5 4.27 9 5.15" />
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
                <a href="<?php echo e(route('admin.products.assign')); ?>"
                    class="<?php echo e(request()->routeIs('admin.products.assign')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                    Assign Certificates
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.products.requests')); ?>"
                    class="<?php echo e(request()->routeIs('admin.products.requests')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                block rounded-md px-2 py-1 text-sm font-medium">
                    View Certificate Requests
                </a>
            </li>
        </ul>
    </li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-reports')): ?>
    <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('admin.reports.*') ? true : false); ?>)">

        <!-- Active Bar -->
        <span
            class="<?php echo e(request()->routeIs('admin.reports.*')
                ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg'
                : ''); ?>"
            aria-hidden="true"></span>

        <!-- Menu Button -->
        <button @click="toggle" type="button"
            class="flex w-full items-start rounded-md text-sm font-semibold text-gray-500
                transition-colors duration-150 hover:text-gray-800
                focus:outline-none dark:text-gray-400 dark:hover:text-gray-200"
            :aria-expanded="open.toString()">

            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-file-text-icon lucide-file-text shrink-0">
                <path
                    d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z" />
                <path d="M14 2v5a1 1 0 0 0 1 1h5" />
                <path d="M10 9H8" />
                <path d="M16 13H8" />
                <path d="M16 17H8" />
            </svg>

            <!-- Label -->
            <span
                class="<?php echo e(request()->routeIs('admin.reports.*')
                    ? 'text-gray-800 dark:text-gray-200'
                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                ml-2 flex-1 text-left transition-all duration-200 origin-left"
                :class="isSidebarCollapsed ? 'hidden' : 'block'">
                Reports
            </span>

            <!-- Dropdown Arrow -->
            <svg class="ml-auto h-4 w-4 transform transition-transform duration-300 ease-in-out"
                :class="[open ? 'rotate-180' : 'rotate-0', isSidebarCollapsed ? 'hidden' : 'block']" fill="currentColor"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 0 1 1.414 0L10 10.586l3.293-3.293a1 1 0 0 1
                                            1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"
                    clip-rule="evenodd">
                </path>
            </svg>
        </button>

        <!-- Submenu -->
        <ul x-ref="panel" :style="`height: ${height}px`" @transitionend="if (open) height = 'auto'"
            class="mt-2 space-y-2 overflow-hidden px-4 transition-all duration-300 ease-in-out"
            :class="isSidebarCollapsed ? 'hidden' : 'block'">

            <li>
                <a href="<?php echo e(route('admin.reports.purchase')); ?>"
                    class="<?php echo e(request()->routeIs('admin.reports.purchase')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                    block rounded-md px-2 py-1 text-sm font-medium">
                    Purchase Report
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.reports.sales')); ?>"
                    class="<?php echo e(request()->routeIs('admin.reports.sales')
                        ? 'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700'
                        : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200'); ?>

                    block rounded-md px-2 py-1 text-sm font-medium">
                    Sales Report
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
    <li class="relative px-6 py-3" x-data="collapsibleMenu(<?php echo e(request()->routeIs('admin.staff.*') ? true : false); ?>)">

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
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-user-icon lucide-user shrink-0">
                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
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
                :class="[open ? 'rotate-180' : 'rotate-0', isSidebarCollapsed ? 'hidden' : 'block']" fill="currentColor"
                viewBox="0 0 20 20">
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
<?php /**PATH C:\xampp\htdocs\zeoradiamonds\resources\views/layouts/sidebar/admin-links.blade.php ENDPATH**/ ?>