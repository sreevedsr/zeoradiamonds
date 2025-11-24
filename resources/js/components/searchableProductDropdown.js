export default function searchableProductDropdown(config = {}) {
    return {
        open: false,
        searchQuery: "",
        options: [],
        filteredOptions: [],
        selected: null,
        apiUrl: config.apiUrl,

        async init() {
            await this.loadProducts();

            // 🔥 Refresh when sale item added
            window.addEventListener("refresh-sale-products", async () => {
                await this.loadProducts();
            });

            // 🔥 Optionally block already-added products
            window.addEventListener("block-products", (e) => {
                const blocked = e.detail.blocked || [];

                this.filteredOptions = this.options.filter(
                    (p) => !blocked.includes(p.product_code),
                );
            });
        },

        async loadProducts() {
            try {
                const res = await fetch(this.apiUrl);
                const data = await res.json();

                this.options = Array.isArray(data)
                    ? data
                    : (data.data ?? data.results ?? []);

                this.filteredOptions = this.options;
            } catch (e) {
                console.error("Product dropdown fetch failed:", e);
                this.options = [];
                this.filteredOptions = [];
            }
        },

        filterOptions() {
            const q = this.searchQuery.toLowerCase();

            this.filteredOptions = this.options.filter((p) =>
                [p.product_code, p.item_name, p.item_code, p.hsn_code]
                    .filter(Boolean)
                    .some((v) => String(v).toLowerCase().includes(q)),
            );
        },

        select(option) {
            this.selected = option;
            this.searchQuery = option.item_name;
            this.open = false;

            window.dispatchEvent(
                new CustomEvent("dropdown-selected", {
                    detail: { selected: option },
                }),
            );
        },
    };
}
