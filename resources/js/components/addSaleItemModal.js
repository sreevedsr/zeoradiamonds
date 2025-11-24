export default function addSaleItemModal() {
    return {
        item: {},
        productSelected: false,

        init() {
            window.addEventListener("open-sale-modal", () => {
                this.resetItem();
            });
        },

        handleProductSelect(event) {
            const c = event.detail.selected;

            this.item = {
                card_id: c.id,
                barcode: c.product_code,
                product_code: c.product_code,
                item_code: c.item_code,
                item_name: c.item_name,
                hsn: c.hsn_code,
                quantity: 1,
                gross_weight: c.gross_weight,
                stone_weight: c.stone_weight,
                diamond_weight: c.diamond_weight,
                net_weight: c.net_weight,
                net_amount: c.net_amount ?? c.total_amount,
                total_amount: c.total_amount,
            };

            this.productSelected = true;
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

            const temp = await res.json();

            document.dispatchEvent(
                new CustomEvent("add-sale-item", {
                    bubbles: true,
                    detail: { temp_sale: temp },
                }),
            );

            document.dispatchEvent(new CustomEvent("refresh-sale-products"));
        },

        resetItem() {
            this.item = {};
            this.productSelected = false;
        },
    };
}
