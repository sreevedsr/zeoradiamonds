export default function itemForm() {
    return {
        item: {
            product_code: '',
            item_code: '',
            item_name: '',
            quantity: 1,
            gold_rate: 0,
            gross_weight: 0,
            stone_weight: 0,
            diamond_weight: 0,
            net_weight: 0,
            stone_amount: 0,
            diamond_price: 0,
            making_charge: 0,
            card_charge: 0,
            other_charge: 0,
            landing_cost: 0,
            retail_percent: 0,
            retail_cost: 0,
            mrp_percent: 0,
            mrp_cost: 0,
            total_amount: 0,
            certificate_id: '',
            color: '',
            clarity: '',
            cut: '',
            diamond_image: null,
        },

        init() {
            this.$watch('item.gross_weight', () => this.calculateNetWeight());
            this.$watch('item.stone_weight', () => this.calculateNetWeight());
            this.$watch('item.diamond_weight', () => this.calculateNetWeight());
            this.$watch('item.gold_rate', () => this.calculateTotals());
            this.$watch('item.making_charge', () => this.calculateTotals());
            this.$watch('item.other_charge', () => this.calculateTotals());
            this.$watch('item.stone_amount', () => this.calculateTotals());
            this.$watch('item.diamond_price', () => this.calculateTotals());
            this.$watch('item.landing_cost', () => this.calculateTotals());
            this.$watch('item.retail_percent', () => this.calculateTotals());
            this.$watch('item.mrp_percent', () => this.calculateTotals());
        },

        // --- Derived Computations ---
        calculateNetWeight() {
            const g = parseFloat(this.item.gross_weight || 0);
            const s = parseFloat(this.item.stone_weight || 0);
            const d = parseFloat(this.item.diamond_weight || 0);
            this.item.net_weight = +(g - (s + d)).toFixed(3);
            this.calculateTotals();
        },

        calculateTotals() {
            const goldValue = (this.item.net_weight || 0) * (this.item.gold_rate || 0);
            const baseTotal = goldValue
                + (this.item.stone_amount || 0)
                + (this.item.diamond_price || 0)
                + (this.item.making_charge || 0)
                + (this.item.card_charge || 0)
                + (this.item.other_charge || 0)
                + (this.item.landing_cost || 0);

            this.item.total_amount = +baseTotal.toFixed(2);
            this.item.retail_cost = +(
                baseTotal + (baseTotal * (this.item.retail_percent || 0) / 100)
            ).toFixed(2);
            this.item.mrp_cost = +(
                baseTotal + (baseTotal * (this.item.mrp_percent || 0) / 100)
            ).toFixed(2);
        },

        formatCurrency(value) {
            if (isNaN(value)) return '₹0.00';
            return '₹' + parseFloat(value).toFixed(2);
        },

        // --- Store Item Locally ---
        addItem() {

            // ✅ Add to Alpine store array
            this.$store.purchaseModal.items.push({ ...this.item });

            // ✅ Persist to localStorage
            localStorage.setItem(
                'purchase_items',
                JSON.stringify(this.$store.purchaseModal.items)
            );

            // ✅ Reset form
            this.resetItem();

            // ✅ Close modal
            this.$store.purchaseModal.close();
        },

        resetItem() {
            this.item = {
                product_code: '',
                item_code: '',
                item_name: '',
                quantity: 1,
                gold_rate: 0,
                gross_weight: 0,
                stone_weight: 0,
                diamond_weight: 0,
                net_weight: 0,
                stone_amount: 0,
                diamond_price: 0,
                making_charge: 0,
                card_charge: 0,
                other_charge: 0,
                landing_cost: 0,
                retail_percent: 0,
                retail_cost: 0,
                mrp_percent: 0,
                mrp_cost: 0,
                total_amount: 0,
                certificate_id: '',
                color: '',
                clarity: '',
                cut: '',
                diamond_image: null,
            };
        },
    };
}
