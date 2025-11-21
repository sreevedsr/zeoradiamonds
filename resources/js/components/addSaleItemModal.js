export default function addSaleItemModal() {
    return {
        item: {},

        init() {
            window.addEventListener("open-sale-modal", () => {
                this.resetItem();
            });

            window.handleProductSelect = (e) => {
                const c = e.detail.selected;

                // Core mapping
                this.item.card_id = c.id;
                this.item.barcode = c.product_code;
                this.item.product_code = c.product_code;

                this.item.item_code = c.item_code;

                // NEW → Item name from products table
                this.item.item_name = c.item_name;

                // NEW → HSN code from products table
                this.item.hsn = c.hsn_code;

                this.item.quantity = 1;
                this.item.gross_weight = c.gross_weight;
                this.item.stone_weight = c.stone_weight;
                this.item.diamond_weight = c.diamond_weight;
                this.item.net_weight = c.net_weight;

                this.item.net_amount = c.net_amount ?? c.total_amount;
                this.item.total_amount = c.total_amount;
            };
        },

        async addItem() {
            const form = new FormData();
            form.append("product_code", this.item.product_code);

            const res = await fetch("/admin/temp-sales", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                    Accept: "application/json",
                },
                body: form,
            });

            if (!res.ok) {
                console.error(await res.text());
                return;
            }

            // This already contains the FLAT joined card data
            const temp = await res.json();

            // Dispatch final structure directly (no remapping)
            document.dispatchEvent(
                new CustomEvent("add-sale-item", {
                    bubbles: true,
                    detail: { temp_sale: temp },
                }),
            );

            // Refresh dropdown
            document.dispatchEvent(new CustomEvent("refresh-sale-products"));
        },

        resetItem() {
            this.item = {};
        },
    };
}
