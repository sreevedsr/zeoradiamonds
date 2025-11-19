export default function saleForm() {
    return {
        errors: {},
        items: [],            // temp_sales table rows
        merchantState: null,  // only for IGST/CGST if needed later

        // Card modal state
        modalCard: null,
        showCardModal: false,

        // -------------------------------------------------------
        // INIT
        // -------------------------------------------------------
        init() {
            this.loadItems();

            window.addEventListener("refresh-sale-items", () => {
                this.loadItems();
            });

            // Card selected from dropdown or search
            window.addEventListener("card-selected", (e) => {
                const c = e.detail.card;
                this.openCardModal(c);
            });
        },

        // -------------------------------------------------------
        // LOAD TEMP SALE ITEMS
        // -------------------------------------------------------
        async loadItems() {
            try {
                const res = await fetch("/admin/temp-sales");
                if (res.ok) {
                    const data = await res.json();
                    this.items = data.items ?? [];
                }
            } catch (e) {
                console.error("Failed to load temp sale items:", e);
            }
        },

        // -------------------------------------------------------
        // OPEN/CLOSE CARD MODAL
        // -------------------------------------------------------
        openCardModal(card) {
            this.modalCard = {
                id: card.id,
                card_number: card.card_number,
                certificate_id: card.certificate_id,
                product_code: card.product_code,
            };
            this.showCardModal = true;
        },

        closeCardModal() {
            this.showCardModal = false;
            this.modalCard = null;
        },

        // -------------------------------------------------------
        // ADD CARD → TEMP_SALES
        // -------------------------------------------------------
        async addCardToItems() {
            if (!this.modalCard?.id) return;

            const form = new FormData();
            form.append("card_id", this.modalCard.id);

            const res = await fetch("/admin/temp-sales", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content
                },
                body: form,
            });

            if (!res.ok) {
                console.error(await res.text());
                return;
            }

            this.showCardModal = false;
            this.modalCard = null;

            window.dispatchEvent(new CustomEvent("refresh-sale-items"));
        },

        // -------------------------------------------------------
        // REMOVE ITEM FROM TEMP_SALES
        // -------------------------------------------------------
        async removeItem(id) {
            const res = await fetch(`/admin/temp-sales/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content
                },
            });

            if (res.ok) {
                this.loadItems();
            }
        }
    };
}
