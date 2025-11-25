export default function searchableDropdown(config = {}) {
    return {
        open: false,
        searchQuery: "",
        options: [],
        filteredOptions: [],
        merchantSelected: null,
        selectedId: "",
        apiUrl: config.apiUrl || null,
        sourceKey: config.sourceKey || null,
        optionLabel: config.optionLabel || "name",
        optionValue: config.optionValue || "id",
        cacheDuration: 15 * 60 * 1000, // 15 minutes

        async init() {
            try {
                // 🟣 1. Prefer combined API if sourceKey exists
                if (this.sourceKey) {
                    const cached = this.getCachedData();
                    if (cached) {
                        this.options = cached[this.sourceKey] || [];
                    } else {
                        const res = await fetch("/api/dropdown/combined");
                        if (!res.ok)
                            throw new Error(
                                "Failed to load combined dropdown data",
                            );
                        const allData = await res.json();
                        this.setCachedData(allData);
                        this.options = allData[this.sourceKey] || [];
                    }
                }
                // 🟣 2. Otherwise use custom API
                else if (this.apiUrl) {
                    const res = await fetch(this.apiUrl);
                    if (!res.ok)
                        throw new Error(
                            `Failed to load data from ${this.apiUrl}`,
                        );

                    const data = await res.json();

                    // ✅ Handle both array and wrapped response
                    if (Array.isArray(data)) {
                        this.options = data;
                    } else if (data.data && Array.isArray(data.data)) {
                        this.options = data.data;
                    } else if (data.results && Array.isArray(data.results)) {
                        this.options = data.results;
                    } else {
                        console.warn(
                            "⚠️ Unexpected dropdown response format:",
                            data,
                        );
                        this.options = [];
                    }
                }

                this.filteredOptions = this.options;
                console.log(
                    `✅ Loaded ${this.options.length} options from`,
                    this.apiUrl || this.sourceKey,
                );
            } catch (error) {
                console.error("❌ Dropdown fetch error:", error);
                this.options = [];
                this.filteredOptions = [];
            }
        },

        // 🟢 Cache management (for combined dropdown)
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
            localStorage.setItem(
                "dropdownCache",
                JSON.stringify({ data, timestamp: Date.now() }),
            );
        },

        // 🟢 Client-side filtering
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
                    option.item_name,
                    option.item_code,
                    option.hsn,
                ]
                    .filter(Boolean)
                    .map((v) => String(v).toLowerCase());

                return values.some((v) => v.includes(query));
            });
        },

        // 🟢 Select an option
        select(option) {
            this.merchantSelected = option;
            this.selectedId = option[this.optionValue];
            this.searchQuery = option[this.optionLabel];
            this.open = false;

            // Broadcast Alpine event
            this.$dispatch("dropdown-selected", { merchantSelected: option });

            // Focus next input field automatically
            this.$nextTick(() => {
                const focusables = Array.from(
                    document.querySelectorAll(
                        "input, select, textarea, button",
                    ),
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
