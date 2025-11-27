// resources/js/app.js
import "./bootstrap";
import Alpine from "alpinejs";

// Import all components
import 'flowbite';
import 'flowbite-datepicker';

import data from "./alpine/data.js";
import stateCode from "./components/stateCode.js";
import pageTransition from "./components/pageTransition.js";
import purchaseForm from "./components/purchaseForm.js";
import saleForm from "./components/saleForm.js";
import addSaleItemModal from "./components/addSaleItemModal.js";
import collapsibleMenu from "./components/collapsibleMenu.js";
import searchableDropdown from "./components/searchableDropdown.js";
import editModal from './components/editModal';
import dropdownComponent from './components/dropdowns.js';
import searchableProductDropdown from "./components/searchableProductDropdown.js";
import { inlineSaleItem } from './components/saleForm';


import {
    enableSequentialInput,
    focusFirstInput,
} from "./utils/formNavigation.js";

function globalRates() {
    return {
        gold_rate: 0,
        diamond_rate: 0,

        init() {
            this.fetchGoldRate();
            this.fetchDiamondRate();

            // Refresh rates whenever the modal opens
            window.addEventListener("open-purchase-modal", () => {
                this.fetchGoldRate();
                this.fetchDiamondRate();
            });
        },

        async fetchGoldRate() {
            try {
                const res = await fetch("/admin/api/latest-gold-rate");
                this.gold_rate = (await res.json()).rate ?? 0;
            } catch (e) {
                console.error("Failed gold rate", e);
            }
        },

        async fetchDiamondRate() {
            try {
                const res = await fetch("/admin/api/latest-diamond-rate");
                this.diamond_rate = (await res.json()).rate ?? 0;
            } catch (e) {
                console.error("Failed diamond rate", e);
            }
        },
    };
}

window.Alpine = Alpine;

// 🧰 Attach helpers globally (so Blade can use them)

window.enableSequentialInput = enableSequentialInput;
window.focusFirstInput = focusFirstInput;
window.searchableDropdown = searchableDropdown;
window.searchableProductDropdown = searchableProductDropdown;
window.inlineSaleItem = inlineSaleItem;
window.dropdownComponent = dropdownComponent;



Alpine.data("data", data);
Alpine.data("globalRates", globalRates);
Alpine.data("stateCode", stateCode);
Alpine.data("pageTransition", pageTransition);
Alpine.data("purchaseForm", purchaseForm);
Alpine.data("saleForm", saleForm);
Alpine.data("addSaleItemModal", addSaleItemModal);
Alpine.data("collapsibleMenu", collapsibleMenu);
Alpine.data('editModal', editModal);


Alpine.start();

// ✅ Global HTML5 validation customization (unrelated but clean)
document.addEventListener("DOMContentLoaded", () => {
    document
        .querySelectorAll(
            "input[required], select[required], textarea[required]",
        )
        .forEach((el) => {
            el.addEventListener("invalid", () => {
                el.setCustomValidity(
                    `Please fill the ${el.name.replace("_", " ")} field.`,
                );
            });
            el.addEventListener("input", () => el.setCustomValidity(""));
        });
});
