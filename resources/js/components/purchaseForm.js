// resources/js/components/purchaseForm.js
export default function purchaseForm(globalGoldRate, globalDiamondRate) {
    return {
        errors: {},

        // -----------------------------
        // Validation
        // -----------------------------
        validateItem() {
            this.errors = {};

            // Sync auto fields
            this.item.gold_rate = this.gold_rate;
            this.item.diamond_rate = this.diamond_rate;

            // Required Text Fields
            const requiredText = [
                "product_code",
                "item_code",
                "item_name",
                "certificate_id",
                "color",
                "clarity",
                "cut",
            ];

            requiredText.forEach((field) => {
                if (!this.item[field] || this.item[field].toString().trim() === "") {
                    this.errors[field] = "This field is required.";
                }
            });

            // Required Numeric Fields (>0)
            const requiredNumbers = [
                "quantity",
                "gross_weight",
                "stone_weight",
                "diamond_weight",
                "gold_rate",
                "total_amount",
                "landing_cost",
                "stone_amount",
                "diamond_rate",
                "making_charge",
                "card_charge",
                "other_charge",
            ];

            requiredNumbers.forEach((field) => {
                const value = parseFloat(this.item[field]);
                if (isNaN(value) || value <= 0) {
                    this.errors[field] = "Enter a valid number greater than 0.";
                }
            });

            // Optional Numeric Fields (>= 0)
            const optionalNumbers = ["retail_percent", "mrp_percent"];

            optionalNumbers.forEach((field) => {
                const value = parseFloat(this.item[field]);
                if (!isNaN(value) && value < 0) {
                    this.errors[field] = "Value cannot be negative.";
                }
            });

            // Images
            if (this.item.certificate_image && !(this.item.certificate_image instanceof File)) {
                this.errors.certificate_image = "Invalid certificate image.";
            }

            if (this.item.product_image && !(this.item.product_image instanceof File)) {
                this.errors.product_image = "Invalid product image.";
            }

            // Net weight
            const netWeight = parseFloat(this.item.net_weight);
            if (isNaN(netWeight) || netWeight <= 0) {
                this.errors.net_weight = "Net weight must be greater than 0.";
            }

            return Object.keys(this.errors).length === 0;
        },

        // -----------------------------
        // UI State
        // -----------------------------
        accordion: {
            purchaseOpen: true,
            cardOpen: false,
        },

        // Main Item Object
        item: {
            product_code: "",
            item_code: "",
            item_name: "",
            quantity: 1,

            gross_weight: "",
            stone_weight: "",
            diamond_weight: "",
            gold_rate: globalGoldRate,
            diamond_rate: globalDiamondRate,
            stone_amount: "",
            making_charge: "",
            card_charge: "",
            other_charge: "",

            net_weight: "",
            gold_component: "",
            total_amount: "",
            landing_cost: "",

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

        // Other UI flags
        shapePanel: false,
        shapePanelOpen: false,

        // -----------------------------
        // Lifecycle
        // -----------------------------
        init() {
            // Dropdown sync
            window.addEventListener("dropdown-selected", (e) => {
                this.item.item_code = e.detail.selected.item_code;
                this.item.item_name = e.detail.selected.item_name;
            });

            // Watch real fields
            const watchedFields = [
                "item.gross_weight",
                "item.stone_weight",
                "item.diamond_weight",
                "item.stone_amount",
                "gold_rate",
                "diamond_rate",
                "item.making_charge",
                "item.card_charge",
                "item.other_charge",
                "item.retail_percent",
                "item.mrp_percent",
            ];

            watchedFields.forEach((field) => {
                this.$watch(field, () => this.recalculateAll());
            });

            // Recalculate once on init
            this.recalculateAll();
        },

        // -----------------------------
        // Utility Helpers
        // -----------------------------
        safeNumber(value) {
            const num = parseFloat(value);
            return isNaN(num) ? 0 : num;
        },

        diamondWeightInGrams() {
            const carats = parseFloat(this.item.diamond_weight);
            return isNaN(carats) || carats <= 0 ? 0 : +(carats * 0.002).toFixed(3);
        },

        // -----------------------------
        // Derived Computations
        // -----------------------------
        recalculateAll() {
            const newNet = this.calculateNetWeight();
            const newGold = this.calculateGoldComponent(newNet);
            const newTotal = this.calculateTotalAmount(newGold);
            const newLanding = this.calculateLandingCost(newTotal, newGold);
            const newRetail = this.calculateRetailCost(newLanding);
            const newMrp = this.calculateMrpCost(newLanding);

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
            const d = this.diamondWeightInGrams();
            const result = g - (s + d);
            return result > 0 ? +result.toFixed(3) : 0;
        },

        calculateGoldComponent(netWeight = this.item.net_weight) {
            return +(this.safeNumber(netWeight) * this.safeNumber(this.gold_rate)).toFixed(2);
        },

        calculateTotalAmount(goldComponent = this.item.gold_component) {
            const gold = this.safeNumber(goldComponent);
            const stone = this.safeNumber(this.item.stone_amount);
            const diamond = this.safeNumber(this.diamond_rate);

            const charges =
                this.safeNumber(this.item.making_charge) +
                this.safeNumber(this.item.card_charge) +
                this.safeNumber(this.item.other_charge);

            return +(gold + stone + diamond + charges).toFixed(2);
        },

        calculateLandingCost(total = this.item.total_amount, gold = this.item.gold_component) {
            const val = this.safeNumber(total) - this.safeNumber(gold);
            return val > 0 ? +val.toFixed(2) : 0;
        },

        calculateRetailCost(landing = this.item.landing_cost) {
            const p = this.safeNumber(this.item.retail_percent);
            return +(landing * (1 + p / 100)).toFixed(2);
        },

        calculateMrpCost(landing = this.item.landing_cost) {
            const p = this.safeNumber(this.item.mrp_percent);
            return +(landing * (1 + p / 100)).toFixed(2);
        },

        // -----------------------------
        // Barcode
        // -----------------------------
        generateBarcodeData() {
            return JSON.stringify({
                pc: this.item.product_code,
                mrp: this.item.mrp_cost,
                gr: this.gold_rate,
            });
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

        // -----------------------------
        // Add Item Handler
        // -----------------------------
        async addItem() {
            if (!this.validateItem()) {
                console.warn("Validation failed:", this.errors);
                return;
            }

            this.item.barcode_data = this.generateBarcodeData();

            try {
                const response = await fetch("/admin/temp-items", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content,
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(this.item),
                });

                if (response.status === 422) {
                    const result = await response.json();
                    if (result.error) {
                        this.$nextTick(() => {
                            this.errors.product_code = result.error;
                        });
                    }
                    return;
                }

                if (!response.ok) {
                    console.error("Server Response:", await response.text());
                    return;
                }

                window.dispatchEvent(new CustomEvent("refresh-temp-items"));
                this.resetItem();

                this.$nextTick(() => {
                    window.dispatchEvent(new Event("close-purchase-modal"));
                });
            } catch (error) {
                console.error("Add Item Error:", error);
            }
        },

        // -----------------------------
        // Reset Item
        // -----------------------------
        resetItem() {
            Object.keys(this.item).forEach((key) => {
                this.item[key] = typeof this.item[key] === "number" ? 0 : "";
            });

            this.item.quantity = 1;
        },
    };
}
