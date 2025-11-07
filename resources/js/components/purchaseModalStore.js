// resources/js/components/purchaseModalStore.js

export default function registerPurchaseModalStore(Alpine) {
    Alpine.store("purchaseModal", {
        show: false,
        items: [],

        open() {
            this.show = true;
        },

        close() {
            this.show = false;
        },

        addItem() {
            const form = document.getElementById("itemForm");
            const formData = new FormData(form);
            const item = Object.fromEntries(formData.entries());

            // Simple validation
            if (!item.item_name || !item.gross_weight) {
                alert("Please fill in required fields before adding.");
                return;
            }

            // ✅ Add item to the store
            this.items.push(item);

            // ✅ Persist to localStorage
            this.saveToLocal();

            // Reset and close modal
            form.reset();
            this.close();
        },

        removeItem(index) {
            this.items.splice(index, 1);
            this.saveToLocal(); // ✅ Update localStorage when item removed
        },

        // --- LocalStorage handling ---
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

        clearAll() {
            this.items = [];
            localStorage.removeItem("purchase_items");
        },
    });

    // Alpine component for purchase form
    Alpine.data("purchaseFormComponent", () => ({
        items: Alpine.store("purchaseModal").items,

        init() {
            console.log("Purchase form initialized");

            // ✅ Load items from localStorage when component mounts
            Alpine.store("purchaseModal").loadFromLocal();

            // ✅ Optional: sync with other tabs
            window.addEventListener("storage", () =>
                Alpine.store("purchaseModal").loadFromLocal()
            );
        },

        openModal() {
            Alpine.store("purchaseModal").open();
        },

        removeItem(index) {
            this.items.splice(index, 1);
            Alpine.store("purchaseModal").saveToLocal(); // ensure sync
        },

        clearAll() {
            Alpine.store("purchaseModal").clearAll();
        },
    }));
}
