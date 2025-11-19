export default function addSaleItemModal({ lookupUrl }) {
    return {
        lookupUrl: null,
        item: {
            si_no: "",
            barcode: "",
            item_code: "",
            item_name: "",
            hsn: "",
            quantity: 1,
            gross_weight: 0,
            stone_weight: 0,
            diamond_weight: 0,
            net_weight: 0,
            net_amount: 0,
            total_amount: 0,

            intraState: true,
            cgst: 0,
            sgst: 0,
            igst: 0,
        },

        product: null,
        merchantState: null,

        init() {
            window.addEventListener("product-selected", (e) => {
                const p = e.detail.product;
                this.product = p;

                this.fetchCardByProductCode(p.product_code);
            });

            window.addEventListener("merchant-state", (e) => {
                this.merchantState = e.detail.state;
                this.recalculateTaxes();
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
            const form = new FormData();

            form.append("barcode", this.item.barcode);
            form.append("product_code", this.item.item_code);

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

            window.dispatchEvent(new CustomEvent("refresh-sale-items"));
        },
    };
}
