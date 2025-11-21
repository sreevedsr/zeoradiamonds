export default function saleForm() {
    return {
        items: [],
        errorMessage: null,
        deleteId: null,

        async init() {
            // Load items from backend (already flat structure)
            const res = await fetch("/admin/temp-sales");
            const data = await res.json();

            this.items = data.items || [];
            this.updateBlockedProducts();

            // Listen for add-sale-item event
            document.addEventListener("add-sale-item", (e) => {
                const temp = e.detail.temp_sale;

                // Prevent duplicates
                if (
                    this.items.some((i) => i.product_code === temp.product_code)
                ) {
                    this.errorMessage = "This item is already added.";
                    return;
                }

                // Push flat item
                this.items.push({
                    id: temp.id,
                    product_code: temp.product_code,
                    item_name: temp.item_name,
                    hsn_code: temp.hsn_code,
                    net_weight: temp.net_weight,
                    net_amount: temp.net_amount,
                    total_amount: temp.total_amount,
                });

                this.updateBlockedProducts();

                window.dispatchEvent(new CustomEvent("refresh-sale-products"));
            });

            // Delete confirmation listener
            window.addEventListener("confirm-delete", () => {
                if (this.deleteId) {
                    this.removeItem(this.deleteId);
                    window.dispatchEvent(new CustomEvent("refresh-sale-products"));
                    this.deleteId = null;
                }

                window.dispatchEvent(
                    new CustomEvent("close-modal", {
                        detail: "confirm-delete-modal",
                    }),
                );
            });
        },

        openDeleteModal(id) {
            this.deleteId = id;
            window.dispatchEvent(
                new CustomEvent("open-modal", {
                    detail: "confirm-delete-modal",
                }),
            );
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
                this.updateBlockedProducts();
            }
        },

        updateBlockedProducts() {
            const blocked = this.items.map((i) => i.product_code);

            window.dispatchEvent(
                new CustomEvent("block-products", {
                    detail: { blocked },
                }),
            );
        },
    };
}
