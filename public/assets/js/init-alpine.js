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

        toggleSidebar() {
            if (this.isMobile) {
                this.isSideMenuOpen = !this.isSideMenuOpen;
            } else {
                this.isSidebarCollapsed = !this.isSidebarCollapsed;
                document.body.classList.toggle(
                    "sidebar-collapsed",
                    this.isSidebarCollapsed
                );
            }
        },

        // Side menu
        isSideMenuOpen: false,
        toggleSideMenu() {
            this.isSideMenuOpen = !this.isSideMenuOpen;
        },
        closeSideMenu() {
            this.isSideMenuOpen = false;
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
