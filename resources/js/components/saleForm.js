export default function saleForm() {
    return {
        items: [],

        init() {
            // Listen for item added from modal
            window.addEventListener("add-sale-item", (e) => {
                this.items.push(e.detail.item);
            });
        },

        // Optional - If you want delete functionality later
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
