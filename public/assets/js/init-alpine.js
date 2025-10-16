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
        // toggleTheme() {
        //     this.dark = !this.dark;
        //     setThemeToLocalStorage(this.dark);
        //     if (this.dark) {
        //         document.documentElement.classList.add("theme-dark");
        //     } else {
        //         document.documentElement.classList.remove("theme-dark");
        //     }
        // },
        isSideMenuOpen: false,
        toggleSideMenu() {
            this.isSideMenuOpen = !this.isSideMenuOpen;
        },
        closeSideMenu() {
            this.isSideMenuOpen = false;
        },
        isNotificationsMenuOpen: false,
        toggleNotificationsMenu() {
            this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen;
        },
        closeNotificationsMenu() {
            this.isNotificationsMenuOpen = false;
        },
        isProfileMenuOpen: false,
        toggleProfileMenu() {
            this.isProfileMenuOpen = !this.isProfileMenuOpen;
        },
        closeProfileMenu() {
            this.isProfileMenuOpen = false;
        },
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
            this.trapCleanup();
        },
    };
}
