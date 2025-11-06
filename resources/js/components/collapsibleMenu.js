// resources/js/components/collapsibleMenu.js
export default (isOpen = false) => ({
    open: isOpen,
    height: 0,

    setMeasured() {
        this.height = this.$refs.panel ? this.$refs.panel.scrollHeight : 0;
    },

    toggle() {
        if (!this.open) {
            this.setMeasured();
            this.open = true;
        } else {
            this.close();
        }
    },

    close() {
        if (this.open) {
            this.height = this.$refs.panel ? this.$refs.panel.scrollHeight : 0;
            this.$nextTick(() => {
                this.height = 0;
                this.open = false;
            });
        }
    },

    collapse() {
        // Close immediately when sidebar collapses
        this.height = 0;
        this.open = false;
    },

    init() {
        this.$nextTick(() => {
            if (this.open) this.setMeasured();

            const resizeHandler = () => {
                if (this.open) this.setMeasured();
            };
            window.addEventListener("resize", resizeHandler);

            // Watch for menu open state manually
            this.$watch("open", (val) => {
                if (val) this.setMeasured();
            });

            // ✅ Listen to the global collapse event
            const collapseHandler = () => this.collapse();
            document.addEventListener("sidebar:collapse", collapseHandler);

            // ✅ Alpine v3-style cleanup
            Alpine.effect(() => {
                return () => {
                    window.removeEventListener("resize", resizeHandler);
                    document.removeEventListener("sidebar:collapse", collapseHandler);
                };
            });
        });
    },
});
