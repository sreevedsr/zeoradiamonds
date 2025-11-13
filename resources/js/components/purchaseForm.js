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
            product_code: "",
            item_code: "",
            item_name: "",
            quantity: 1,

            gross_weight: "",
            stone_weight: "",
            diamond_weight: "",
            gold_rate: "",
            diamond_rate: "",
            stone_amount: "",
            making_charge: "",
            card_charge: "",
            other_charge: "",

            net_weight: "",
            gold_component: "",
            total_amount: "",
            landing_cost: "",

            // Final standardized fields
            retail_percent: "",
            retail_cost: "",
            mrp_percent: "",
            mrp_cost: "",

            certificate_id: "",
            color: "",
            clarity: "",
            cut: "",
            certificate_image: "",
            product_image: "",
            notes: "",
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

            // Only watch input fields — not computed ones
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
            return isNaN(carats) || carats <= 0 ? 0 : +(carats * 0.002).toFixed(3);
        },

        // --- Derived Computations ---
        recalculateAll() {
            // compute values first
            const newNet = this.calculateNetWeight();
            const newGold = this.calculateGoldComponent(newNet);
            const newTotal = this.calculateTotalAmount(newGold);
            const newLanding = this.calculateLandingCost(newTotal, newGold);
            const newRetail = this.calculateRetailCost(newLanding);
            const newMrp = this.calculateMrpCost(newLanding);

            // only update if changed (prevents loops)
            if (this.item.net_weight !== newNet) this.item.net_weight = newNet;
            if (this.item.gold_component !== newGold) this.item.gold_component = newGold;
            if (this.item.total_amount !== newTotal) this.item.total_amount = newTotal;
            if (this.item.landing_cost !== newLanding) this.item.landing_cost = newLanding;
            if (this.item.retail_cost !== newRetail) this.item.retail_cost = newRetail;
            if (this.item.mrp_cost !== newMrp) this.item.mrp_cost = newMrp;
        },

        calculateNetWeight() {
            const g = this.safeNumber(this.item.gross_weight);
            const s = this.safeNumber(this.item.stone_weight);
            const d = this.diamondWeightInGrams(); // convert carats to grams
            const result = g - (s + d);
            return result > 0 ? +result.toFixed(3) : 0;
        },

        calculateGoldComponent(netWeight = this.item.net_weight) {
            const net = this.safeNumber(netWeight);
            const rate = this.safeNumber(this.item.gold_rate);
            console.log("Gold " + (net * rate).toFixed(2));
            return +(net * rate).toFixed(2);
        },

        async fetchGoldRate() {
            try {
                const res = await fetch("/admin/api/latest-gold-rate");
                const data = await res.json();
                this.item.gold_rate = data.rate ?? 0;
                console.log("Fetched Gold Rate:", this.item.gold_rate);
            } catch (e) {
                console.error("Failed to fetch gold rate:", e);
            }
        },

        async fetchDiamondRate() {
            try {
                const res = await fetch("/admin/api/latest-diamond-rate");
                const data = await res.json();
                this.item.diamond_rate = data.rate ?? 0;
                console.log("Fetched Diamond Rate:", this.item.diamond_rate);
            } catch (e) {
                console.error("Failed to fetch diamond rate:", e);
            }
        },

        calculateTotalAmount(goldComponent = this.item.gold_component) {
            const gold = this.safeNumber(goldComponent);
            const stone = this.safeNumber(this.item.stone_amount);
            const diamond = this.safeNumber(this.item.diamond_rate);
            const charges =
                this.safeNumber(this.item.making_charge) +
                this.safeNumber(this.item.card_charge) +
                this.safeNumber(this.item.other_charge);

            return +(gold + stone + diamond + charges).toFixed(2);
        },

        calculateLandingCost(total = this.item.total_amount, gold = this.item.gold_component) {
            console.log("🔍 calculateLandingCost() called with:");
            console.log("   total_amount:", total);
            console.log("   gold_component:", gold);

            const suggested = this.safeNumber(total) - this.safeNumber(gold);

            console.log("   safe total:", this.safeNumber(total));
            console.log("   safe gold:", this.safeNumber(gold));
            console.log("   calculated landing cost:", suggested > 0 ? +suggested.toFixed(2) : 0);
            console.log("--------------------------------------");

            return suggested > 0 ? +suggested.toFixed(2) : 0;
        },

        calculateRetailCost(landing = this.item.landing_cost) {
            const percent = this.safeNumber(this.item.retail_percent);
            return +(landing * (1 + percent / 100)).toFixed(2);
        },

        calculateMrpCost(landing = this.item.landing_cost) {
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
                num.toLocaleString("en-IN", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                })
            );
        },

        async addItem() {
            try {
                const response = await fetch("/admin/temp-items", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content,
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(this.item),
                });

                const result = await response.text();

                if (!response.ok) {
                    console.error("Server Response:", result);
                    alert("Failed to save item.");
                    return;
                }

                window.dispatchEvent(new CustomEvent("refresh-temp-items"));
                this.resetItem();

                // Tell parent Alpine component to close the modal
                window.dispatchEvent(new Event("close-purchase-modal"));
            } catch (error) {
                console.error("Add Item Error:", error);
            }
        },

        resetItem() {
            Object.keys(this.item).forEach((key) => {
                this.item[key] = typeof this.item[key] === "number" ? 0 : "";
            });
            this.item.quantity = 1;
        },
    };
}
