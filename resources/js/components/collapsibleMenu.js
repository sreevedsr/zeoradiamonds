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
            if (this.$refs.panel) {
                this.height = this.$refs.panel.scrollHeight;
                this.$nextTick(() => {
                    this.height = 0;
                    this.open = false;
                });
            } else {
                this.height = 0;
                this.open = false;
            }
        }
    },

    init() {
        this.$nextTick(() => {
            if (this.open) this.setMeasured();

            const resizeHandler = () => {
                if (this.open) this.setMeasured();
            };

            window.addEventListener("resize", resizeHandler);

            this.$watch("open", (val) => {
                if (val) this.setMeasured();
            });

            this.$cleanup(() => {
                window.removeEventListener("resize", resizeHandler);
            });
        });
    },
});
