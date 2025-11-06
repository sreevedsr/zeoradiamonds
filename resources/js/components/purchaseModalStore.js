// resources/js/components/purchaseModalStore.js

export default function registerPurchaseModalStore(Alpine) {
    Alpine.store("purchaseModal", {
        show: false,
        items: [],
        open() { this.show = true },
        close() { this.show = false },
        addItem() {
            const form = document.getElementById("itemForm");
            const formData = new FormData(form);
            const item = Object.fromEntries(formData.entries());

            // Simple validation
            if (!item.item_name || !item.gross_weight) {
                alert("Please fill in required fields before adding.");
                return;
            }

            this.items.push(item);
            form.reset();
            this.close();
        },
    });

    // Register the Alpine component
    Alpine.data("purchaseFormComponent", () => ({
        items: Alpine.store("purchaseModal").items,
        init() {
            console.log("Purchase form initialized");
        },
        openModal() {
            Alpine.store("purchaseModal").open();
        },
        removeItem(index) {
            this.items.splice(index, 1);
        },
    }));
}
