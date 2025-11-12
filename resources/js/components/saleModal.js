// resources/js/components/saleModal.js
import { enableSequentialInput, focusFirstInput } from "../utils/formNavigation";

/**
 * Sales Modal Alpine Store + saleItemForm component
 * Self-registering Alpine module.
 */
document.addEventListener("alpine:init", () => {
    // 🟢 Store registration
    Alpine.store("saleModal", {
        show: false,
        items: [],

        open() {
            this.show = true;

            Alpine.nextTick(() => {
                const modalForm = document.querySelector("#saleItemForm");
                if (modalForm) {
                    enableSequentialInput(modalForm);
                    focusFirstInput(modalForm);
                }
            });
        },

        close() {
            this.show = false;
        },

        clear() {
            this.items = [];
            this.saveToLocal();
        },

        add(item) {
            this.items.push(item);
            this.saveToLocal();
        },

        remove(index) {
            this.items.splice(index, 1);
            this.saveToLocal();
        },

        loadFromLocal() {
            const stored = localStorage.getItem("sale_items");
            if (stored) this.items = JSON.parse(stored);
        },

        saveToLocal() {
            localStorage.setItem("sale_items", JSON.stringify(this.items));
        },
    });

    // 🟢 Component registration
    Alpine.data("saleItemForm", () => ({
        si_no: "",
        barcode: "",
        product_code: "",
        item_code: "",
        item_name: "",
        hsn: "",
        quantity: 1,
        gross_weight: 0,
        stone_weight: 0,
        diamond_weight: 0,
        net_weight: 0,
        net_amount: 0,
        cgst_amount: 0,
        sgst_amount: 0,
        igst_amount: 0,
        total_amount_display: "0.00",
        intraState: true,
        merchant_state_code: "",
        merchant_state: "",
        company_state: window?.companyState || "Kerala",

        init() {
            this.listenForProductSelection();
        },

        listenForProductSelection() {
            document.addEventListener("product-selected", (e) => {
                const product = e.detail.product;
                this.fillProductDetails(product);
            });
        },

        fillProductDetails(data) {
            this.product_code = data.product_code || "";
            this.item_code = data.item_code || "";
            this.item_name = data.item_name || "";
            this.hsn = data.hsn || "";
            this.quantity = data.quantity || 1;
            this.gross_weight = data.gross_weight || 0;
            this.stone_weight = data.stone_weight || 0;
            this.diamond_weight = data.diamond_weight || 0;
            this.net_weight = data.net_weight || 0;
            this.net_amount = data.total_amount || 0;
            this.recomputeTaxes();
        },

        recomputeTaxes() {
            const netAmt = parseFloat(this.net_amount) || 0;
            this.intraState = String(this.merchant_state_code || "").trim() === "29";

            if (this.intraState) {
                this.cgst_amount = +(netAmt * 0.015).toFixed(2);
                this.sgst_amount = +(netAmt * 0.015).toFixed(2);
                this.igst_amount = 0;
            } else {
                this.igst_amount = +(netAmt * 0.03).toFixed(2);
                this.cgst_amount = 0;
                this.sgst_amount = 0;
            }

            const total = netAmt + this.cgst_amount + this.sgst_amount + this.igst_amount;
            this.total_amount_display = total.toFixed(2);
        },

        formatMoney(v) {
            return (parseFloat(v) || 0).toFixed(2);
        },

        addItem() {
            const item = {
                si_no: this.si_no,
                barcode: this.barcode,
                product_code: this.product_code,
                item_code: this.item_code,
                item_name: this.item_name,
                hsn: this.hsn,
                quantity: this.quantity,
                gross_weight: this.gross_weight,
                stone_weight: this.stone_weight,
                diamond_weight: this.diamond_weight,
                net_weight: this.net_weight,
                net_amount: this.net_amount,
                cgst_amount: this.cgst_amount,
                sgst_amount: this.sgst_amount,
                igst_amount: this.igst_amount,
                total_amount: this.total_amount_display,
            };

            Alpine.store("saleModal").add(item);
            this.resetForm();
            Alpine.store("saleModal").close();
        },

        resetForm() {
            Object.assign(this, {
                barcode: "",
                product_code: "",
                item_code: "",
                item_name: "",
                hsn: "",
                quantity: 1,
                gross_weight: 0,
                stone_weight: 0,
                diamond_weight: 0,
                net_weight: 0,
                net_amount: 0,
                cgst_amount: 0,
                sgst_amount: 0,
                igst_amount: 0,
                total_amount_display: "0.00",
            });
        },
    }));
});
