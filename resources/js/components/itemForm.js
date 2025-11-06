// resources/js/components/itemForm.js
export default function itemForm() {
    return {
        // Form fields
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

        // Computed fields
        get net_weight() {
            const n =
                Number(this.gross_weight) - Number(this.stone_weight) - Number(this.diamond_weight);
            return n > 0 ? n : 0;
        },

        get total_amount() {
            return (
                this.gold_rate * this.net_weight +
                Number(this.stone_amount || 0) +
                Number(this.diamond_price || 0) +
                Number(this.making_charge || 0) +
                Number(this.card_charge || 0) +
                Number(this.other_charge || 0)
            );
        },

        get retail_cost() {
            return Number(this.landing_cost || 0) * (1 + Number(this.retail_percent || 0) / 100);
        },

        get mrp_cost() {
            return Number(this.landing_cost || 0) * (1 + Number(this.mrp_percent || 0) / 100);
        },

        formatCurrency(value) {
            const n = Number(value || 0);
            return n.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
        },
    };
}
