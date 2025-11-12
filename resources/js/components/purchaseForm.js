// resources/js/components/purchaseForm.js
import QRCode from 'qrcode';

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

        generateQRCodeData() {
            const goldRate = this.item.gold_rate || 0;
            const mrp = this.item.mrp_cost || 0;
            const productCode = this.item.product_code || "N/A";
            const unique = Math.floor(Math.random() * 999999)
                .toString()
                .padStart(6, "0");

            // Create structured data for QR content (JSON)
            return JSON.stringify({
                product_code: productCode,
                gold_rate: goldRate,
                mrp: mrp,
                id: unique,
                generated_at: new Date().toISOString(),
            });
        },

        async generateQRCode() {
            const qrData = this.generateQRCodeData();

            // Use a local QR API (qrcode.js)
            const qrCanvas = document.createElement("canvas");
            await QRCode.toCanvas(qrCanvas, qrData, { width: 200 });

            // Convert to base64 image
            this.item.qr_code = qrCanvas.toDataURL("image/png");
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

        addItem() {
            this.recalculateAll();
            const modal = Alpine.store("purchaseModal");
            modal.items.push({ ...this.item });
            modal.saveToLocal?.();
            this.resetItem();
            modal.close();
        },

        resetItem() {
            Object.keys(this.item).forEach((key) => {
                this.item[key] = typeof this.item[key] === "number" ? 0 : "";
            });
            this.item.quantity = 1;
        },
    };
}
