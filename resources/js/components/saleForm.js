export default function saleForm() {
    return {
        errors: {},
        items: [], // Shared table items (same as purchase)

        // Single item structure
        item: {
            id: null,
            si_no: "",
            barcode: "",
            product_code: "",
            item_code: "",
            item_name: "",
            hsn: "",
            gross_weight: 0,
            stone_weight: 0,
            diamond_weight: 0,
            net_weight: 0,
            quantity: 1,
            net_amount: 0,
            cgst: 0,
            sgst: 0,
            igst: 0,
            total_amount: 0,
            intraState: true,
        },

        // -------------------------------------------------------
        // INIT
        // -------------------------------------------------------
        init() {
            this.loadItems();

            window.addEventListener("refresh-sale-items", () => {
                this.loadItems();
            });

            // When selecting a product from dropdown
            window.addEventListener("product-selected", (e) => {
                const p = e.detail.product;

                this.item.id = p.id ?? null;
                this.item.product_code = p.product_code ?? "";
                this.item.item_code = p.item_code ?? "";
                this.item.item_name = p.item_name ?? "";
                this.item.hsn = p.hsn ?? "";
                this.item.barcode = p.barcode ?? "";

                this.item.quantity = Number(p.quantity ?? 1);
                this.item.gross_weight = +p.gross_weight || 0;
                this.item.stone_weight = +p.stone_weight || 0;
                this.item.diamond_weight = +p.diamond_weight || 0;
                this.item.net_weight = +p.net_weight || 0;

                this.item.net_amount = +p.total_amount || 0;

                this.computeTaxes();
            });
        },

        // -------------------------------------------------------
        // LOAD TABLE ITEMS
        // -------------------------------------------------------
        async loadItems() {
            try {
                const res = await fetch("/admin/temp-sales");
                if (res.ok) {
                    const data = await res.json();
                    this.items = data.items ?? []; // <-- FIX
                }
            } catch (e) {
                console.error("Load sale items failed:", e);
            }
        },
        // -------------------------------------------------------
        // TAX COMPUTATION
        // -------------------------------------------------------
        computeTaxes() {
            const net = +this.item.net_amount || 0;

            if (this.item.intraState) {
                this.item.cgst = +(net * 0.015).toFixed(2);
                this.item.sgst = +(net * 0.015).toFixed(2);
                this.item.igst = 0;
            } else {
                this.item.cgst = 0;
                this.item.sgst = 0;
                this.item.igst = +(net * 0.03).toFixed(2);
            }

            this.item.total_amount = +(
                net +
                this.item.cgst +
                this.item.sgst +
                this.item.igst
            ).toFixed(2);
        },

        // -------------------------------------------------------
        // ADD ITEM
        // -------------------------------------------------------
        async addItem() {
            const form = new FormData();

            Object.keys(this.item).forEach((k) => {
                form.append(k, this.item[k]);
            });

            const res = await fetch("/admin/temp-sales", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content,
                },
                body: form,
            });

            if (!res.ok) {
                console.error(await res.text());
                return;
            }

            window.dispatchEvent(new CustomEvent("refresh-sale-items"));

            this.resetItem();

            this.$dispatch("close-sale-modal");
        },

        // -------------------------------------------------------
        // RESET FORM
        // -------------------------------------------------------
        resetItem() {
            this.item = {
                id: null,
                si_no: "",
                barcode: "",
                product_code: "",
                item_code: "",
                item_name: "",
                hsn: "",
                gross_weight: 0,
                stone_weight: 0,
                diamond_weight: 0,
                net_weight: 0,
                quantity: 1,
                net_amount: 0,
                cgst: 0,
                sgst: 0,
                igst: 0,
                total_amount: 0,
                intraState: true,
            };
        },
    };
}
