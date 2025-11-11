// resources/js/components/purchaseForm.js

export default function purchaseForm() {
    return {
        // --- Accordion UI State ---
        accordion: {
            purchaseOpen: true,
            cardOpen: false,
        },

        // --- Main Item Object (UI clean, backend-safe) ---
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
            gross_weight: "",
            stone_weight: "",
            diamond_weight: "", // entered in carats (UI)
            stone_amount: "",
            gold_rate: "",
            diamond_rate: "",
            making_charge: "",
            card_charge: "",
            other_charge: "",
            landing_cost: "",
            retail_percent: "",
            mrp_percent: "",
            certificate_id: "",
            diamond_purchase_location: "",
            category: "",
            diamond_shape: "",
            color: "",
            clarity: "",
            cut: "",
            valuation: "",
            certificate_code: "",
            net_weight: "",
            gold_component: "",
            total_amount: "",
            retail_cost: "",
            mrp_cost: "",
            diamond_image: null,
        },

        // --- UI Panels ---
        shapePanel: false,
        shapePanelOpen: false,

        // --- Lifecycle ---
        init() {
            window.addEventListener("dropdown-selected", (e) => {
                this.item.item_code = e.detail.selected.item_code;
                this.item.item_name = e.detail.selected.item_name;
            });

            const watchedFields = [
                "item.gross_weight",
                "item.stone_weight",
                "item.diamond_weight",
                "item.stone_amount",
                "item.gold_rate",
                "item.diamond_rate",
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

        // --- Utility Helpers ---
        safeNumber(value) {
            const num = parseFloat(value);
            return isNaN(num) ? 0 : num;
        },

        diamondWeightInGrams() {
            const carats = parseFloat(this.item.diamond_weight);
            if (isNaN(carats) || carats <= 0) return 0;
            return +(carats * 0.002).toFixed(3);
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
            const g = this.safeNumber(this.item.gross_weight);
            const s = this.safeNumber(this.item.stone_weight);
            const d = this.diamondWeightInGrams(); // convert carats to grams
            const result = g - (s + d);
            return result > 0 ? +result.toFixed(3) : 0;
        },

        calculateGoldComponent() {
            const net = this.safeNumber(this.item.net_weight);
            const rate = this.safeNumber(this.item.gold_rate);
            const result = +(net * rate).toFixed(2);

            console.log("Gold Component:", {
                net_weight: net,
                gold_rate: rate,
                gold_component: result,
            });

            return result;
        },

        async fetchGoldRate() {
            try {
                const response = await fetch("/admin/api/latest-gold-rate");
                const data = await response.json();
                this.item.gold_rate = data.rate ?? 0;
                console.log("Fetched Gold Rate:", this.item.gold_rate);
            } catch (error) {
                console.error("Failed to fetch gold rate:", error);
            }
        },

        async fetchDiamondRate() {
            try {
                const response = await fetch("/admin/api/latest-diamond-rate");
                const data = await response.json();
                this.item.diamond_rate = data.rate ?? 0;
                console.log("Fetched Diamond Rate:", this.item.diamond_rate);
            } catch (error) {
                console.error("Failed to fetch diamond rate:", error);
            }
        },

        calculateTotalAmount() {
            const goldComponent = this.safeNumber(this.item.gold_component);
            const stone = this.safeNumber(this.item.stone_amount);
            const diamond = this.safeNumber(this.item.diamond_rate);
            const charges =
                this.safeNumber(this.item.making_charge) +
                this.safeNumber(this.item.card_charge) +
                this.safeNumber(this.item.other_charge);

            const total = goldComponent + stone + diamond + charges;

            console.log("Total Amount Calculation:", {
                gold_component: goldComponent,
                stone_amount: stone,
                diamond_rate: diamond,
                charges,
                total_amount: total,
            });

            return +total.toFixed(2);
        },

        calculateLandingCost() {
            const suggested =
                this.safeNumber(this.calculateTotalAmount()) -
                this.safeNumber(this.calculateGoldComponent());
            return suggested > 0 ? +suggested.toFixed(2) : 0;
        },

        calculateRetailCost() {
            const landing = this.safeNumber(this.calculateLandingCost());
            const percent = this.safeNumber(this.item.retail_percent);
            return +(landing * (1 + percent / 100)).toFixed(2);
        },

        calculateMrpCost() {
            const landing = this.safeNumber(this.calculateLandingCost());
            const percent = this.safeNumber(this.item.mrp_percent);
            return +(landing * (1 + percent / 100)).toFixed(2);
        },

        generateBarcode() {
            const randomCode = Math.random().toString(36).substring(2, 9).toUpperCase();
            this.item.barcode = "BC-" + randomCode;
        },

        formatCurrency(value) {
            const num = parseFloat(value);
            if (isNaN(num)) return "₹0.00";
            return (
                "₹" +
                num.toLocaleString("en-IN", { minimumFractionDigits: 2, maximumFractionDigits: 2 })
            );
        },

        addItem() {
            // ✅ Recalculate before adding
            this.recalculateAll();

            // ✅ Get store safely (this never fails even if async loaded)
            const modal = Alpine.store("purchaseModal");

            // if (!modal) {
            //     console.error("❌ purchaseModal store not found.");
            //     return;
            // }

            // ✅ Push to store and persist
            modal.items.push({ ...this.item });
            modal.saveToLocal?.();

            // ✅ Reset item form
            this.resetItem();

            // ✅ Close modal cleanly
            modal.close();
        },

        resetItem() {
            Object.keys(this.item).forEach((key) => {
                if (typeof this.item[key] === "number") this.item[key] = 0;
                else this.item[key] = "";
            });
            this.item.quantity = 1;
        },
    };
}
