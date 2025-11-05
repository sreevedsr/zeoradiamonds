// resources/js/components/purchaseForm.js

export default function purchaseForm() {
    return {
        // Accordion states
        accordion: {
            purchaseOpen: true, // default open
            cardOpen: false,
        },

        // Form fields (defaults)
        supplier: "",
        invoice_no: "",
        salesman: "",
        si_no: "",
        barcode: "",
        product_code: "",
        item_code: "",
        item_name: "",
        quantity: 1,
        gold_rate: 0,
        gross_weight: 0,
        stone_weight: 0,
        diamond_weight: 0,
        stone_amount: 0,
        diamond_price: 0,
        making_charge: 0,
        card_charge: 0,
        other_charge: 0,
        landing_cost: 0,
        retail_percent: 0,
        mrp_percent: 0,
        certificate_id: "",
        diamond_purchase_location: "",
        category: "",
        diamond_shape: "",
        carat_weight: 0,
        color: "",
        clarity: "",
        cut: "",
        valuation: 0,
        certificate_code: "",

        // UI state
        shapePanel: false,
        shapePanelOpen: false,

        // --- Lifecycle ---
        init() {
            // watch some fields for landing cost suggestion
            this.$watch("gross_weight", () => this.suggestLanding());
            this.$watch("stone_weight", () => this.suggestLanding());
            this.$watch("diamond_weight", () => this.suggestLanding());
            this.$watch("gold_rate", () => this.suggestLanding());
            this.$watch("stone_amount", () => this.suggestLanding());
            this.$watch("diamond_price", () => this.suggestLanding());
            this.$watch("making_charge", () => this.suggestLanding());
            this.$watch("card_charge", () => this.suggestLanding());
            this.$watch("other_charge", () => this.suggestLanding());
            this.suggestLanding();
        },

        // --- Derived values ---
        get net_weight() {
            const n =
                Number(this.gross_weight) - Number(this.stone_weight) - Number(this.diamond_weight);
            return n > 0 ? n : 0;
        },

        get gold_component() {
            return this.net_weight * Number(this.gold_rate || 0);
        },

        get total_amount() {
            const charges =
                Number(this.making_charge || 0) +
                Number(this.card_charge || 0) +
                Number(this.other_charge || 0);
            return (
                Number(this.gold_component || 0) +
                Number(this.stone_amount || 0) +
                Number(this.diamond_price || 0) +
                charges
            );
        },

        suggestLanding() {
            const suggested = Number(this.total_amount) - Number(this.gold_component || 0);
            if (!this.landing_cost || Number(this.landing_cost) === 0) {
                this.landing_cost = suggested > 0 ? parseFloat(suggested.toFixed(2)) : 0;
            }
        },

        get retail_cost() {
            return Number(this.landing_cost || 0) * (1 + Number(this.retail_percent || 0) / 100);
        },

        get mrp_cost() {
            return Number(this.landing_cost || 0) * (1 + Number(this.mrp_percent || 0) / 100);
        },

        // --- Helpers ---
        formatCurrency(value) {
            const n = Number(value || 0);
            return n.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
        },

        onItemNameChange() {
            // placeholder for future item auto-fill
        },

        generateBarcode() {
            if (!this.barcode) {
                this.barcode = "BC-" + Math.random().toString(36).substring(2, 9).toUpperCase();
            } else {
                this.barcode = "BC-" + Math.floor(Math.random() * 1000000);
            }
        },
    };
}
