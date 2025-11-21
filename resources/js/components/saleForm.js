export default function saleForm() {
    return {
        items: [],
        errorMessage: null,

        async init() {
            // Load existing TempSale items from backend
            const res = await fetch("/admin/temp-sales");
            const data = await res.json();

            this.items = (data.items || []).map((item) => ({
                id: item.id,
                product_code: item.card?.product_code,
                item_name: item.card?.item_name,
                quantity: item.card?.quantity ?? 1,
                net_weight: item.card?.net_weight,
                net_amount: item.card?.total_amount,
                total_amount: item.card?.total_amount,
                open: false,
            }));

            // Listen for event from modal
            window.addEventListener("add-sale-item", (e) => {
                const temp = e.detail.temp_sale;

                // Prevent duplicates
                if (
                    this.items.some((i) => i.product_code === temp.product_code)
                ) {
                    this.errorMessage = "This item is already added.";
                    return;
                }

                // Add normalized entry
                this.items.push({
                    id: temp.id,
                    product_code: temp.product_code,
                    quantity: temp.quantity,
                    net_weight: temp.net_weight,
                    net_amount: temp.net_amount,
                    total_amount: temp.total_amount,
                    card: temp.card || {},
                    open: false,
                });
            });
        },

        async removeItem(id) {
            const res = await fetch(`/admin/temp-sales/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        "meta[name=csrf-token]",
                    ).content,
                },
            });

            if (res.ok) {
                this.items = this.items.filter((i) => i.id !== id);
            }
        },

        toggleRow(index) {
            this.items[index].open = !this.items[index].open;
        },
    };
}
