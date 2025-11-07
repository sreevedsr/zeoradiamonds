export default function searchableDropdown(config = {}) {
    return {
        open: false,
        searchQuery: "",
        options: [],
        filteredOptions: [],
        selected: null,
        apiUrl: config.apiUrl,
        optionLabel: config.optionLabel || "name",
        optionValue: config.optionValue || "id",

        async init() {
            const res = await fetch(this.apiUrl);
            this.options = await res.json();
            this.filteredOptions = this.options;
        },

        filterOptions() {
            const q = this.searchQuery.toLowerCase();
            this.filteredOptions = this.options.filter((o) =>
                Object.values(o).some((v) => String(v).toLowerCase().includes(q)),
            );
        },

        select(option) {
            this.selected = option;
            this.searchQuery = option[this.optionLabel];
            this.open = false;

            // 🔹 Move focus to next element automatically
            this.$nextTick(() => {
                const focusables = Array.from(
                    document.querySelectorAll("input, select, textarea, button"),
                );
                const current = document.activeElement;
                const currentIndex = focusables.indexOf(current);
                if (currentIndex >= 0 && focusables[currentIndex + 1]) {
                    focusables[currentIndex + 1].focus();
                }
            });
        },
    };
}
