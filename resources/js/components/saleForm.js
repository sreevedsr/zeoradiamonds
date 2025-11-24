export default function saleForm() {
    return {
        items: [],
        errorMessage: null,
        deleteId: null,

        merchantState: null,
        taxType: null,

        async init() {
            // Load temp sales (server stored)
            const res = await fetch("/admin/temp-sales");
            const data = await res.json();

            this.items = data.items || [];
            this.updateBlockedProducts();

            // Watch merchant dropdown → update tax type
            this.$nextTick(() => {
                const dropdown = document.querySelector(
                    '[x-data^="searchableDropdown"]',
                );

                if (dropdown?._x) {
                    dropdown._x.$watch("selected", (val) => {
                        if (val && val.state) {
                            this.merchantState = val.state;
                            this.updateTaxType();
                        } else {
                            this.merchantState = null;
                            this.taxType = null;
                        }
                    });
                }
            });

            /*
             |-----------------------------------------------------
             | HANDLE "add-sale-item" FROM INLINE ITEM BOX
             |-----------------------------------------------------
             */
            window.addEventListener("add-sale-item", (e) => {
                const item = e.detail;

                // Prevent duplicate product code
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

            /*
             |-----------------------------------------------------
             | DELETE CONFIRMATION (UNCHANGED)
             |-----------------------------------------------------
             */
            window.addEventListener("confirm-delete", () => {
                if (this.deleteId) {
                    this.removeItem(this.deleteId);
                    window.dispatchEvent(
                        new CustomEvent("refresh-sale-products"),
                    );
                    this.deleteId = null;
                }

                window.dispatchEvent(
                    new CustomEvent("close-modal", {
                        detail: "confirm-delete-modal",
                    }),
                );
            });
        },

        updateTaxType() {
            if (!this.merchantState) {
                this.taxType = null;
                return;
            }

            const st = this.merchantState.trim().toLowerCase();
            this.taxType = st === "telangana" ? "cgst_sgst" : "igst";
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

/*
 |-----------------------------------------------------
 | INLINE ADD SALE ITEM COMPONENT
 |-----------------------------------------------------
*/
export function inlineSaleItem() {
    return {
        selected: null,
        item: {},

        handleProduct(option) {
            console.log("HANDLE PRODUCT FIRED:", option);

            this.selected = option;

            this.item = {
                id: option.id,
                si_no: option.id, // You must decide real SI. No
                barcode: option.product_code,
                item_code: option.product_code,
                item_name: option.item_name,

                hsn: option.hsn_code,

                quantity: 1,

                gross_weight: option.gross_weight,
                stone_weight: option.stone_weight,
                diamond_weight: option.diamond_weight,

                net_weight: option.net_weight,

                net_amount: option.total_amount, // no separate net_amount exists
                total_amount: option.total_amount, // correct
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
                    // Notify parent to insert the saved item
                    window.dispatchEvent(
                        new CustomEvent("add-sale-item", {
                            detail: temp, // the DB-backed temp sale row
                        }),
                    );

                    window.dispatchEvent(
                        new CustomEvent("refresh-sale-products"),
                    );
                });

            // Reset fields
            this.selected = null;
            this.item = {};
        },
    };
}
