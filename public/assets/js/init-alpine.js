function data() {
    function isDarkModePreferred() {
        return (
            !!window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        );
    }

    // Apply theme immediately
    if (isDarkModePreferred()) {
        document.documentElement.classList.add("theme-dark");
    } else {
        document.documentElement.classList.remove("theme-dark");
    }

    return {
        dark: isDarkModePreferred(),

        // Responsive + sidebar logic
        isMobile: window.innerWidth < 768,
        isSidebarCollapsed: false,

        updateIsMobile() {
            this.isMobile = window.innerWidth < 768;
        },

        // Desktop sidebar toggle
        toggleSidebar() {
            if (this.isMobile) {
                this.toggleMobileSidebar();
            } else {
                this.isSidebarCollapsed = !this.isSidebarCollapsed;
                document.body.classList.toggle(
                    "sidebar-collapsed",
                    this.isSidebarCollapsed
                );
            }
        },

        // Mobile sidebar logic
        isSideMenuOpen: false,
        isMobileMenuButtonActive: false,

        toggleMobileSidebar() {
            this.isSideMenuOpen = !this.isSideMenuOpen;
            this.isMobileMenuButtonActive = !this.isMobileMenuButtonActive;
        },

        closeSideMenu() {
            this.isSideMenuOpen = false;
            this.isMobileMenuButtonActive = false;
        },

        // Notifications
        isNotificationsMenuOpen: false,
        toggleNotificationsMenu() {
            this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen;
        },
        closeNotificationsMenu() {
            this.isNotificationsMenuOpen = false;
        },

        // Profile menu
        isProfileMenuOpen: false,
        toggleProfileMenu() {
            this.isProfileMenuOpen = !this.isProfileMenuOpen;
        },
        closeProfileMenu() {
            this.isProfileMenuOpen = false;
        },

        // Pages menu
        isPagesMenuOpen: false,
        togglePagesMenu() {
            this.isPagesMenuOpen = !this.isPagesMenuOpen;
        },

        // Modal
        isModalOpen: false,
        trapCleanup: null,
        openModal() {
            this.isModalOpen = true;
            this.trapCleanup = focusTrap(document.querySelector("#modal"));
        },
        closeModal() {
            this.isModalOpen = false;
            if (this.trapCleanup) this.trapCleanup();
        },

        // Init
        init() {
            window.addEventListener("resize", () => this.updateIsMobile());
        },
    };
}
