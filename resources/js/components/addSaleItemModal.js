export default function addSaleItemModal() {
    return {
        item: {
            si_no: "",
            barcode: "",
            item_code: "",
            item_name: "",
            hsn: "",
            quantity: "",
            gross_weight: "",
            stone_weight: "",
            diamond_weight: "",
            net_weight: "",
            net_amount: "",
            total_amount: "",
        },

        init() {
              window.addEventListener("open-sale-modal", () => {
                this.resetItem();
            });
            window.handleProductSelect = (e) => {
                const c = e.detail.selected;

                // CORE FIELD MAPPING
                this.item.card_id = c.id;
                this.item.barcode = c.product_code;

                this.item.item_code = c.item_code;
                this.item.item_name = c.item_name;
                this.item.hsn = c.hsn_code ?? "";

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
            form.append("product_code", this.item.barcode);

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

            // Add final item to main grid
            window.dispatchEvent(
                new CustomEvent("add-sale-item", {
                    detail: {
                        temp_sale: {
                            barcode: this.item.barcode,
                            item_name: this.item.item_name,
                            quantity: 1,
                            net_weight: this.item.net_weight,
                            net_amount: this.item.net_amount,
                            total_amount: this.item.total_amount,
                        },
                    },
                }),
            );
        },
        resetItem() {
            this.item = {
                si_no: "",
                barcode: "",
                product_code: "",
                item_code: "",
                item_name: "",
                hsn: "",
                quantity: "",
                gross_weight: "",
                stone_weight: "",
                diamond_weight: "",
                net_weight: "",
                net_amount: "",
                total_amount: "",
                cgst: "",
                sgst: "",
                igst: "",
                intraState: true,
            };
        },
    };
}
