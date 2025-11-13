// resources/js/components/purchaseModalStore.js

export default function registerPurchaseModalStore(Alpine) {
    Alpine.store("purchaseModal", {
        show: false,
        items: [],
        mode: "purchase", // 🔹 'purchase' or 'sales'
        storageKey: "purchase_items",

        // --- Modal Control ---
        open(mode = "purchase") {
            this.mode = mode;
            this.storageKey = mode === "sales" ? "sale_items" : "purchase_items";
            this.show = true;

            // Wait for DOM to settle
            setTimeout(() => {
                const modal = document.querySelector('[x-show="$store.purchaseModal.show"]');
                if (!modal) return;

                focusFirstInput(modal);
                enableSequentialInput(modal, "#add-item-btn");
            }, 250);
        },

        close() {
            this.show = false;
        },

        // --- Item Handling ---
        addItem(item) {
            this.items.push(item);
            this.saveToLocal();
        },

        removeItem(index) {
            this.items.splice(index, 1);
            this.saveToLocal();
        },

        clearAll() {
            this.items = [];
            localStorage.removeItem(this.storageKey);
        },

        // --- Local Storage Persistence ---
        saveToLocal() {
            localStorage.setItem(this.storageKey, JSON.stringify(this.items));
        },

        loadFromLocal() {
            const stored = localStorage.getItem(this.storageKey);
            if (stored) {
                try {
                    this.items = JSON.parse(stored);
                } catch (e) {
                    console.error(`Failed to parse saved items (${this.storageKey}):`, e);
                    this.items = [];
                }
            }
        },
    });

    // --- Helper Component for Page Sync ---
    Alpine.data("purchaseFormComponent", () => ({
        init() {
            console.log("Purchase/Sales form initialized");

            const store = Alpine.store("purchaseModal");
            store.loadFromLocal();

            // Sync across tabs
            window.addEventListener("storage", () => store.loadFromLocal());
        },

        get items() {
            return Alpine.store("purchaseModal").items;
        },

        openModal(mode = "purchase") {
            Alpine.store("purchaseModal").open(mode);
        },

        removeItem(index) {
            Alpine.store("purchaseModal").removeItem(index);
        },

        clearAll() {
            Alpine.store("purchaseModal").clearAll();
        },
    }));
}
