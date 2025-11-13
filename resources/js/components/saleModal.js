// resources/js/components/saleModal.js
import { enableSequentialInput, focusFirstInput } from "../utils/formNavigation";

document.addEventListener("alpine:init", () => {
    // ------------------------------------------------------------
    // 🔵 Sale Item Form Component (Modal)
    // ------------------------------------------------------------
    Alpine.data("saleItemForm", () => ({
        // REQUIRED FIELDS FOR BLADE
        si_no: "",
        barcode: "",
        product_code: "",
        item_code: "",
        item_name: "",
        hsn: "",

        // WEIGHTS
        gross_weight: 0,
        stone_weight: 0,
        diamond_weight: 0,
        net_weight: 0,

        // AMOUNTS
        quantity: 1,
        net_amount: 0,
        total_amount_display: "0.00",

        // TAX FLAGS
        intraState: true,
        cgst_amount: 0,
        sgst_amount: 0,
        igst_amount: 0,

        // INTERNAL ID
        id: null,

        init() {
            // Auto-focus inputs when modal opens
            this.$watch("open", (val) => {
                if (val && this.$refs.saleForm) {
                    enableSequentialInput(this.$refs.saleForm);
                    focusFirstInput(this.$refs.saleForm);
                }
            });

            // When user selects product from dropdown
            document.addEventListener("product-selected", (e) => {
                const p = e.detail.product;

                this.id = p.id ?? null;

                this.product_code = p.product_code ?? "";
                this.item_code = p.item_code ?? "";
                this.item_name = p.item_name ?? "";
                this.hsn = p.hsn ?? "";

                this.barcode = p.barcode ?? "";

                this.quantity = Number(p.quantity ?? 1);
                this.gross_weight = Number(p.gross_weight ?? 0);
                this.stone_weight = Number(p.stone_weight ?? 0);
                this.diamond_weight = Number(p.diamond_weight ?? 0);
                this.net_weight = Number(p.net_weight ?? 0);

                this.net_amount = Number(p.total_amount ?? 0);
                this.total_amount_display = this.net_amount.toFixed(2);

                this.computeTaxes();
            });
        },

        // ------------------------------------------------------------
        // TAX CALCULATIONS
        // ------------------------------------------------------------
        computeTaxes() {
            const net = Number(this.net_amount);

            if (this.intraState) {
                this.cgst_amount = +(net * 0.015).toFixed(2);
                this.sgst_amount = +(net * 0.015).toFixed(2);
                this.igst_amount = 0;
            } else {
                this.cgst_amount = 0;
                this.sgst_amount = 0;
                this.igst_amount = +(net * 0.03).toFixed(2);
            }

            this.total_amount_display = (
                net +
                this.cgst_amount +
                this.sgst_amount +
                this.igst_amount
            ).toFixed(2);
        },

        formatMoney(v) {
            return (parseFloat(v) || 0).toFixed(2);
        },

        // ------------------------------------------------------------
        // SAVE ITEM INTO DB
        // ------------------------------------------------------------
        async addItem() {
            const form = new FormData();
            form.append("id", this.id);
            form.append("quantity", this.quantity);
            form.append("net_weight", this.net_weight);
            form.append("net_amount", this.net_amount);
            form.append("total_amount", this.total_amount_display);
            form.append("cgst", this.cgst_amount);
            form.append("sgst", this.sgst_amount);
            form.append("igst", this.igst_amount);

            const res = await fetch("/admin/temp-sales", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    Accept: "application/json",
                },
                body: form,
            });

            if (!res.ok) {
                console.error("Server:", await res.text());
                return;
            }

            // Reload the main table
            window.dispatchEvent(new CustomEvent("refresh-sales-table"));

            this.closeModal();
        },

        // ------------------------------------------------------------
        // CLOSE MODAL + RESET
        // ------------------------------------------------------------
        closeModal() {
            this.resetForm();
            document.getElementById("saleModalClose")?.click();
        },

        resetForm() {
            Object.assign(this, {
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
                total_amount_display: "0.00",

                intraState: true,
                cgst_amount: 0,
                sgst_amount: 0,
                igst_amount: 0,

                id: null,
            });
        },
    }));

    // ------------------------------------------------------------
    // 🔵 Sales Table Component (DB-Driven)
    // ------------------------------------------------------------
    Alpine.data("salesTable", () => ({
        items: [],

        async init() {
            await this.loadItems();

            window.addEventListener("refresh-sales-table", () => {
                this.loadItems();
            });
        },

        async loadItems() {
            try {
                const res = await fetch("/admin/temp-sales");
                if (!res.ok) return;

                this.items = await res.json();
            } catch (err) {
                console.error("Fetch failed:", err);
            }
        },
    }));
});
