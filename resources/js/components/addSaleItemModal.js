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
            window.addEventListener("card-loaded", (e) => {
                const c = e.detail.card;

                this.item.card_id = c.id;
                this.item.barcode = c.product_code;

                // MAP FIELDS
                this.item.item_code = c.item_code;
                this.item.item_name = c.item_name;
                this.item.hsn = c.hsn ?? c.hsn_code ?? "";
                this.item.quantity = c.quantity;
                this.item.gross_weight = c.gross_weight;
                this.item.stone_weight = c.stone_weight;
                this.item.diamond_weight = c.diamond_weight;
                this.item.net_weight = c.net_weight;

                // Net Amount and Total Amount
                this.item.net_amount = c.total_amount; // based on your earlier mapping
                this.item.total_amount = c.total_amount;
            });
        },

        // Called after any update
        recalculate() {
            this.item.net_weight =
                parseFloat(this.item.gross_weight) -
                (parseFloat(this.item.stone_weight) +
                    parseFloat(this.item.diamond_weight));

            this.item.net_amount =
                this.item.net_weight * (this.product?.rate ?? 0);

            this.item.total_amount = this.item.net_amount;

            this.recalculateTaxes();
        },

        recalculateTaxes() {
            if (!this.merchantState) return;

            const shopState = "{{ config('app.shop_state') }}"; // or pass dynamically

            this.item.intraState = this.merchantState === shopState;

            if (this.item.intraState) {
                this.item.cgst = this.item.total_amount * 0.015;
                this.item.sgst = this.item.total_amount * 0.015;
                this.item.igst = 0;
            } else {
                this.item.igst = this.item.total_amount * 0.03;
                this.item.cgst = 0;
                this.item.sgst = 0;
            }
        },
        async fetchCardByProductCode(productCode) {
            try {
                const url = `${this.lookupUrl}?product_code=${productCode}`;
                const response = await fetch(url);

                if (!response.ok) {
                    console.error("Lookup API error:", await response.text());
                    return;
                }

                const data = await response.json();

                if (!data.length) {
                    console.error("No card found for", productCode);
                    return;
                }

                const card = data[0];

                // Fill item fields with card details
                this.item.barcode = card.product_code;
                this.item.item_code = card.item_code;
                this.item.item_name = card.item_name;
                this.item.hsn = card.hsn;

                this.item.quantity = card.quantity ?? 1;
                this.item.gross_weight = card.gross_weight;
                this.item.stone_weight = card.stone_weight;
                this.item.diamond_weight = card.diamond_weight;
                this.item.net_weight = card.net_weight;
                this.item.total_amount = card.total_amount;

                this.recalculate();
            } catch (err) {
                console.error("Error fetching card:", err);
            }
        },
        async addItem() {
            // 1. Save to backend (minimal fields)
            const form = new FormData();
            form.append("product_code", this.item.barcode);

            const res = await fetch("/admin/temp-sales", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                },
                body: form,
            });

            if (!res.ok) {
                console.error(await res.text());
                return;
            }

            // 2. Push the full card details into the main saleForm() items array
            window.dispatchEvent(
                new CustomEvent("add-sale-item", {
                    detail: {
                        item: {
                            barcode: this.item.barcode,
                            item_name: this.item.item_name,
                            quantity: this.item.quantity,
                            net_weight: this.item.net_weight,
                            net_amount: this.item.net_amount,
                            total_amount: this.item.total_amount,
                        },
                    },
                }),
            );
        },
    };
}
