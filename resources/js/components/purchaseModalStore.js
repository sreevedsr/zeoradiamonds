// resources/js/components/purchaseModalStore.js

export default function registerPurchaseModalStore(Alpine) {
    Alpine.store("purchaseModal", {
        show: false,
        items: [],

        open() {
            this.show = true;

            // Wait until Alpine has updated the DOM and transitions are applied
            setTimeout(() => {
                const modal = document.querySelector('[x-show="$store.purchaseModal.show"]');
                if (!modal) return;

                // ✅ Focus the first input inside modal
                focusFirstInput(modal);

                // ✅ Enable sequential Enter navigation
                enableSequentialInput(modal, "#add-item-btn");
            }, 250); // Matches transition duration (250ms)
        },

        close() {
            this.show = false;
        },

        // --- Item Handling (now handled by purchaseForm, but store persists) ---
        saveToLocal() {
            localStorage.setItem("purchase_items", JSON.stringify(this.items));
        },

        loadFromLocal() {
            const stored = localStorage.getItem("purchase_items");
            if (stored) {
                try {
                    this.items = JSON.parse(stored);
                } catch (e) {
                    console.error("Failed to parse saved items:", e);
                    this.items = [];
                }
            }
        },

        removeItem(index) {
            this.items.splice(index, 1);
            this.saveToLocal();
        },

        clearAll() {
            this.items = [];
            localStorage.removeItem("purchase_items");
        },
    });

    // --- Optional Alpine data helper for syncing ---
    Alpine.data("purchaseFormComponent", () => ({
        init() {
            console.log("Purchase form initialized");

            // Load persisted items on mount
            Alpine.store("purchaseModal").loadFromLocal();

            // Sync across tabs
            window.addEventListener("storage", () => Alpine.store("purchaseModal").loadFromLocal());
        },

        get items() {
            return Alpine.store("purchaseModal").items;
        },

        openModal() {
            Alpine.store("purchaseModal").open();
        },

        removeItem(index) {
            Alpine.store("purchaseModal").removeItem(index);
        },

        clearAll() {
            Alpine.store("purchaseModal").clearAll();
        },
    }));
}
