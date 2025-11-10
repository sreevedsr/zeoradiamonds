// resources/js/components/purchaseForm.js

export default function purchaseForm() {
    return {
        // --- Accordion UI State ---
        accordion: {
            purchaseOpen: true,
            cardOpen: false,
        },

        // --- Main Item Object ---
        item: {
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
            net_weight: 0, // computed and updated live
        },

        // --- UI Panels ---
        shapePanel: false,
        shapePanelOpen: false,

        // --- Lifecycle ---
        init() {
            // Watch for dropdown-selected event
            window.addEventListener("dropdown-selected", (e) => {
                this.item.item_code = e.detail.selected.item_code;
                this.item.item_name = e.detail.selected.item_name;
            });

            // Auto-calculation watchers
            const watchedFields = [
                "item.gross_weight",
                "item.stone_weight",
                "item.diamond_weight",
                "item.gold_rate",
                "item.stone_amount",
                "item.diamond_price",
                "item.making_charge",
                "item.card_charge",
                "item.other_charge",
                "item.retail_percent",
                "item.mrp_percent",
            ];

            watchedFields.forEach((field) => {
                this.$watch(field, () => this.recalculateAll());
            });

            this.recalculateAll();
        },

        // --- Derived Computations ---
        recalculateAll() {
            this.item.net_weight = this.calculateNetWeight();
            this.item.gold_component = this.calculateGoldComponent();
            this.item.total_amount = this.calculateTotalAmount();
            this.item.landing_cost = this.calculateLandingCost();
            this.item.retail_cost = this.calculateRetailCost();
            this.item.mrp_cost = this.calculateMrpCost();
        },

        calculateNetWeight() {
            const g = parseFloat(this.item.gross_weight || 0);
            const s = parseFloat(this.item.stone_weight || 0);
            const d = parseFloat(this.item.diamond_weight || 0);
            const result = g - (s + d);
            return result > 0 ? +result.toFixed(3) : 0;
        },

        calculateGoldComponent() {
            return +(this.item.net_weight * parseFloat(this.item.gold_rate || 0)).toFixed(2);
        },

        calculateTotalAmount() {
            const gold = this.calculateGoldComponent();
            const stone = parseFloat(this.item.stone_amount || 0);
            const diamond = parseFloat(this.item.diamond_price || 0);
            const charges =
                parseFloat(this.item.making_charge || 0) +
                parseFloat(this.item.card_charge || 0) +
                parseFloat(this.item.other_charge || 0);

            return +(gold + stone + diamond + charges).toFixed(2);
        },

        calculateLandingCost() {
            const suggested =
                parseFloat(this.calculateTotalAmount()) - parseFloat(this.calculateGoldComponent());
            return suggested > 0 ? +suggested.toFixed(2) : 0;
        },

        calculateRetailCost() {
            const landing = parseFloat(this.calculateLandingCost());
            const percent = parseFloat(this.item.retail_percent || 0);
            return +(landing * (1 + percent / 100)).toFixed(2);
        },

        calculateMrpCost() {
            const landing = parseFloat(this.calculateLandingCost());
            const percent = parseFloat(this.item.mrp_percent || 0);
            return +(landing * (1 + percent / 100)).toFixed(2);
        },

        // --- Helpers ---
        formatCurrency(value) {
            if (isNaN(value)) return "₹0.00";
            return "₹" + parseFloat(value).toFixed(2);
        },

        generateBarcode() {
            const randomCode = Math.random().toString(36).substring(2, 9).toUpperCase();
            this.item.barcode = "BC-" + randomCode;
        },
    };
}
