export default function dropdownComponent(config) {
    return {
        open: false,
        options: [],
        filteredOptions: [],
        searchQuery: "",
        selected: null,

        apiUrl: config.apiUrl,
        optionLabel: config.optionLabel,
        optionValue: config.optionValue,

        init(initialValue) {
            this.loadOptions().then(() => {
                if (initialValue) {
                    const match = this.options.find(
                        (o) => o[this.optionValue] == initialValue,
                    );
                    if (match) this.choose(match, false);
                }
            });
        },

        async loadOptions() {
            const res = await fetch(this.apiUrl);
            const data = await res.json();

            this.options = Array.isArray(data)
                ? data
                : data.data || data.results || [];
            this.filteredOptions = this.options;
        },

        toggle() {
            this.open = !this.open;

            if (this.open) this.$nextTick(() => this.positionMenu());
        },

        close() {
            this.open = false;
        },

        positionMenu() {
            const rect = this.$el.getBoundingClientRect();
            const menu = this.$refs.menu;

            menu.style.position = "absolute";
            menu.style.top = rect.bottom + "px";
            menu.style.left = rect.left + "px";
            menu.style.width = rect.width + "px";
            menu.style.zIndex = 999999;
        },

        filterOptions() {
            const q = this.searchQuery.toLowerCase();

            this.filteredOptions = q
                ? this.options.filter((o) =>
                      String(o[this.optionLabel]).toLowerCase().includes(q),
                  )
                : this.options;
        },

        choose(option, autoSubmit = true) {
            this.selected = option;
            this.$refs.hiddenInput.value = option[this.optionValue];
            this.close();

            if (autoSubmit && this.autoSubmit) {
                this.$el.closest("form").submit();
            }
        },
        clearSelection() {
            this.selected = null;
            this.$refs.hiddenInput.value = "";
            this.close();
        },

        get selectedLabel() {
            return this.selected ? this.selected[this.optionLabel] : "";
        },
    };
}
