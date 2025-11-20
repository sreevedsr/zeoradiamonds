// resources/js/components/purchaseForm.js
export default function purchaseForm(globalGoldRate, globalDiamondRate) {
    return {
        errors: {},

        validateItem() {
            this.errors = {};

            // Sync auto fields
            this.item.gold_rate = this.gold_rate;
            this.item.diamond_rate = this.diamond_rate;

            /* ------------------------------
             * REQUIRED TEXT FIELDS
             * ------------------------------ */
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
                if (
                    !this.item[field] ||
                    this.item[field].toString().trim() === ""
                ) {
                    this.errors[field] = "This field is required.";
                }
            });

            /* ------------------------------
             * REQUIRED NUMERIC FIELDS (> 0)
             * ------------------------------ */
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

            /* ------------------------------
             * OPTIONAL NUMERIC FIELDS
             * (CAN BE 0 BUT NOT NEGATIVE)
             * ------------------------------ */
            const optionalNumbers = ["retail_percent", "mrp_percent"];

            optionalNumbers.forEach((field) => {
                const value = parseFloat(this.item[field]);
                if (!isNaN(value) && value < 0) {
                    this.errors[field] = "Value cannot be negative.";
                }
            });

            /* ------------------------------
             * IMAGE VALIDATION
             * ------------------------------ */
            if (
                this.item.certificate_image &&
                !(this.item.certificate_image instanceof File)
            ) {
                this.errors.certificate_image = "Invalid certificate image.";
            }

            if (
                this.item.product_image &&
                !(this.item.product_image instanceof File)
            ) {
                this.errors.product_image = "Invalid product image.";
            }

            /* ------------------------------
             * SPECIAL CASES
             * ------------------------------ */

            // Net Weight: Must be > 0
            const netWeight = parseFloat(this.item.net_weight);
            if (isNaN(netWeight) || netWeight <= 0) {
                this.errors.net_weight = "Net weight must be greater than 0.";
            }

            // Retail % → retail_cost must match formula if value exists
            if (this.item.retail_percent && this.item.landing_cost > 0) {
                const expected =
                    (this.item.landing_cost * this.item.retail_percent) / 100;
                if (expected <= 0) {
                    this.errors.retail_percent = "Invalid retail percentage.";
                }
            }

            // MRP % → mrp_cost must match formula if value exists
            if (this.item.mrp_percent && this.item.landing_cost > 0) {
                const expected =
                    (this.item.landing_cost * this.item.mrp_percent) / 100;
                if (expected <= 0) {
                    this.errors.mrp_percent = "Invalid MRP percentage.";
                }
            }

            /* ------------------------------
             * RETURN
             * ------------------------------ */
            return Object.keys(this.errors).length === 0;
        },

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

            this.recalculateAll();
        },

        // --- Utility Helpers ---
        safeNumber(value) {
            const num = parseFloat(value);
            return isNaN(num) ? 0 : num;
        },

        diamondWeightInGrams() {
            const carats = parseFloat(this.item.diamond_weight);
            return isNaN(carats) || carats <= 0
                ? 0
                : +(carats * 0.002).toFixed(3);
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
            if (this.item.gold_component !== newGold)
                this.item.gold_component = newGold;
            if (this.item.total_amount !== newTotal)
                this.item.total_amount = newTotal;
            if (this.item.landing_cost !== newLanding)
                this.item.landing_cost = newLanding;
            if (this.item.retail_cost !== newRetail)
                this.item.retail_cost = newRetail;
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
            const rate = this.safeNumber(this.gold_rate);
            console.log("Gold " + (net * rate).toFixed(2));
            return +(net * rate).toFixed(2);
        },

        // async fetchGoldRate() {
        //     try {
        //         const res = await fetch("/admin/api/latest-gold-rate");
        //         const data = await res.json();
        //         this.item.gold_rate = data.rate ?? 0;
        //         console.log("Fetched Gold Rate:", this.item.gold_rate);
        //     } catch (e) {
        //         console.error("Failed to fetch gold rate:", e);
        //     }
        // },

        // async fetchDiamondRate() {
        //     try {
        //         const res = await fetch("/admin/api/latest-diamond-rate");
        //         const data = await res.json();
        //         this.item.diamond_rate = data.rate ?? 0;
        //         console.log("Fetched Diamond Rate:", this.item.diamond_rate);
        //     } catch (e) {
        //         console.error("Failed to fetch diamond rate:", e);
        //     }
        // },

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

        calculateLandingCost(
            total = this.item.total_amount,
            gold = this.item.gold_component,
        ) {
            console.log("🔍 calculateLandingCost() called with:");
            console.log("   total_amount:", total);
            console.log("   gold_component:", gold);

            const suggested = this.safeNumber(total) - this.safeNumber(gold);

            console.log("   safe total:", this.safeNumber(total));
            console.log("   safe gold:", this.safeNumber(gold));
            console.log(
                "   calculated landing cost:",
                suggested > 0 ? +suggested.toFixed(2) : 0,
            );
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
                        "X-CSRF-TOKEN": document.querySelector(
                            "meta[name=csrf-token]",
                        ).content,
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(this.item),
                });

                // 422 → Validation failed (show inline error, not alert)
                if (response.status === 422) {
                    const result = await response.json();

                    // Backend unique check message
                    if (result.error) {
                        this.$nextTick(() => {
                            this.errors.product_code = result.error;
                        });
                    }

                    return; // stop, no alert, no modal close
                }

                // Non-validation errors → optional logging
                if (!response.ok) {
                    console.error("Server Response:", await response.text());
                    return;
                }

                // Success
                window.dispatchEvent(new CustomEvent("refresh-temp-items"));
                this.resetItem();
                this.$nextTick(() => {
                    window.dispatchEvent(new Event("close-purchase-modal"));
                });
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
