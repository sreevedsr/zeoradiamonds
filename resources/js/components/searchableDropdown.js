export default function searchableDropdown(config = {}) {
    return {
        open: false,
        searchQuery: "",
        options: [],
        filteredOptions: [],
        selected: null,
        selectedId: "",
        apiUrl: config.apiUrl || null, // optional
        sourceKey: config.sourceKey || null, // e.g., "suppliers", "staff", "products", "merchants"
        optionLabel: config.optionLabel || "name",
        optionValue: config.optionValue || "id",
        cacheDuration: 15 * 60 * 1000, // 15 minutes

        async init() {
            try {
                // ✅ Prefer combined data when sourceKey provided
                if (this.sourceKey) {
                    const cached = this.getCachedData();
                    if (cached) {
                        this.options = cached[this.sourceKey] || [];
                    } else {
                        const res = await fetch("/api/dropdown/combined");
                        if (!res.ok) throw new Error("Failed to load combined dropdown data");
                        const allData = await res.json();
                        this.setCachedData(allData);
                        this.options = allData[this.sourceKey] || [];
                    }
                }
                // ✅ Fallback: direct API URL if no sourceKey
                else if (this.apiUrl) {
                    const res = await fetch(this.apiUrl);
                    if (!res.ok) throw new Error("Failed to load dropdown data");
                    this.options = await res.json();
                }

                this.filteredOptions = this.options;
            } catch (error) {
                console.error("Dropdown fetch error:", error);
                this.options = [];
                this.filteredOptions = [];
            }
        },

        // Cache management
        getCachedData() {
            const cache = localStorage.getItem("dropdownCache");
            if (!cache) return null;

            const { data, timestamp } = JSON.parse(cache);
            if (Date.now() - timestamp > this.cacheDuration) {
                localStorage.removeItem("dropdownCache");
                return null;
            }
            return data;
        },

        setCachedData(data) {
            localStorage.setItem("dropdownCache", JSON.stringify({ data, timestamp: Date.now() }));
        },

        filterOptions() {
            const query = this.searchQuery.trim().toLowerCase();

            if (!query) {
                this.filteredOptions = this.options;
                return;
            }

            this.filteredOptions = this.options.filter((option) => {
                const values = [
                    option[this.optionLabel],
                    option.merchant_code,
                    option.supplier_code,
                    option.business_name,
                    option.state,
                ]
                    .filter(Boolean)
                    .map((v) => String(v).toLowerCase());

                return values.some((v) => v.includes(query));
            });
        },

        select(option) {
            this.selected = option;
            this.selectedId = option[this.optionValue];
            this.searchQuery = option[this.optionLabel];
            this.open = false;

            // Emit event for other Alpine components
            this.$dispatch("dropdown-selected", { selected: option });

            // Focus next input field
            this.$nextTick(() => {
                const focusables = Array.from(
                    document.querySelectorAll("input, select, textarea, button"),
                ).filter((el) => !el.disabled && el.tabIndex >= 0);

                const current = document.activeElement;
                const currentIndex = focusables.indexOf(current);

                if (currentIndex >= 0 && focusables[currentIndex + 1]) {
                    focusables[currentIndex + 1].focus();
                }
            });
        },
    };
}
