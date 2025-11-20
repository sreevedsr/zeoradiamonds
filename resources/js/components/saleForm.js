export default function saleForm() {
    return {
        items: [],

        async init() {
            // Load items from backend
            const res = await fetch("/admin/temp-sales");
            const data = await res.json();
            this.items = data.items;

            // Listen for new item
            window.addEventListener("add-sale-item", (e) => {
                this.items.push(e.detail.temp_sale);
            });
        },

        async removeItem(id) {
            const res = await fetch(`/admin/temp-sales/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content
                }
            });

            if (res.ok) {
                this.items = this.items.filter(i => i.id !== id);
            }
        }
    };
}
