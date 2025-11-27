export default function data() {

    return {
        // Desktop sidebar collapse state
        isSidebarCollapsed: false,

        // Desktop sidebar toggle (desktop-only button triggers this)
        toggleSidebar() {
            this.isSidebarCollapsed = !this.isSidebarCollapsed;
            document.body.classList.toggle(
                "sidebar-collapsed",
                this.isSidebarCollapsed,
            );
        },

        // Mobile sidebar state
        isSideMenuOpen: false,
        isMobileMenuButtonActive: false,

        // Mobile sidebar toggle (mobile-only button triggers this)
        toggleMobileSidebar() {
            this.isSideMenuOpen = !this.isSideMenuOpen;
            this.isMobileMenuButtonActive = !this.isMobileMenuButtonActive;
        },

        closeSideMenu() {
            this.isSideMenuOpen = false;
            this.isMobileMenuButtonActive = false;
        },
    };
}
