export default function saleForm() {
    return {
        items: [],
        errorMessage: null,
        deleteId: null,

        async init() {
            // Load temp sales from server
            const res = await fetch("/admin/temp-sales");
            const data = await res.json();

            this.items = data.items || [];
            this.updateBlockedProducts();

            // Listen for inserted sale items
            window.addEventListener("add-sale-item", (e) => {
                const item = e.detail;

                // Prevent duplicate
                if (this.items.some((i) => i.product_code === item.item_code)) {
                    this.errorMessage = "This item is already added.";
                    return;
                }

                this.items.push({
                    id: item.id || null,
                    product_code: item.item_code,
                    item_name: item.item_name,
                    hsn_code: item.hsn,
                    net_weight: item.net_weight,
                    quantity: item.quantity ?? 1,
                    net_amount: item.net_amount,
                    total_amount: item.total_amount,
                });

                this.updateBlockedProducts();
                window.dispatchEvent(new CustomEvent("refresh-sale-products"));
            });

            // Delete item listener
            window.addEventListener("confirm-delete", () => {
                if (this.deleteId) {
                    this.removeItem(this.deleteId);
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
                new CustomEvent("block-products", { detail: { blocked } }),
            );
        },
    };
}
export function inlineSaleItem() {
    return {
        selectedProduct: null,
        item: {},

        handleProduct(option) {
            this.selectedProduct = option;

            this.item = {
                id: option.id,
                si_no: option.id,
                barcode: option.product_code,
                item_code: option.product_code,
                item_name: option.item_name,

                hsn: option.hsn_code,
                quantity: 1,

                net_weight: option.net_weight,
                net_amount: option.total_amount,
                total_amount: option.total_amount,
            };
        },

        addToParent() {
            const form = new FormData();
            form.append("product_code", this.item.item_code);

            fetch("/admin/temp-sales", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                    Accept: "application/json",
                },
                body: form,
            })
                .then((res) => res.json())
                .then((temp) => {
                    window.dispatchEvent(
                        new CustomEvent("add-sale-item", { detail: temp }),
                    );
                    window.dispatchEvent(
                        new CustomEvent("refresh-sale-products"),
                    );
                    window.dispatchEvent(
                        new CustomEvent("reset-product-dropdown"),
                    );
                });

            this.selectedProduct = null;
            this.item = {};
        },
    };
}
