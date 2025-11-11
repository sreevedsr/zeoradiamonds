// resources/js/app.js
import './bootstrap';
import Alpine from 'alpinejs';

// Import all components
import stateCode from './components/stateCode.js';
import pageTransition from './components/pageTransition.js';
import purchaseForm from './components/purchaseForm.js';
import collapsibleMenu from './components/collapsibleMenu.js';
import searchableDropdown from './components/searchableDropdown.js';
import registerPurchaseModalStore from './components/purchaseModalStore.js';
import { enableSequentialInput, focusFirstInput } from './utils/formNavigation.js';

// 🧩 Attach Alpine globally
window.Alpine = Alpine;

// 🧰 Attach helpers globally (so Blade can use them)
window.enableSequentialInput = enableSequentialInput;
window.focusFirstInput = focusFirstInput;
window.searchableDropdown = searchableDropdown;

// ✅ Register global Alpine store BEFORE Alpine.start()
registerPurchaseModalStore(Alpine);

// ✅ Register components
Alpine.data('stateCode', stateCode);
Alpine.data('pageTransition', pageTransition);
Alpine.data('purchaseForm', purchaseForm);
Alpine.data('collapsibleMenu', collapsibleMenu);

// ✅ Load store data AFTER Alpine initializes
document.addEventListener('alpine:init', () => {
    const store = Alpine.store('purchaseModal');
    if (store && store.loadFromLocal) {
        store.loadFromLocal();

        // Optional: keep synced across tabs
        window.addEventListener('storage', () => store.loadFromLocal());
    }
});

// ✅ Finally, start Alpine after everything is registered
Alpine.start();

// ✅ Global HTML5 validation customization (unrelated but clean)
document.addEventListener('DOMContentLoaded', () => {
    document
        .querySelectorAll('input[required], select[required], textarea[required]')
        .forEach((el) => {
            el.addEventListener('invalid', () => {
                el.setCustomValidity(`Please fill the ${el.name.replace('_', ' ')} field.`);
            });
            el.addEventListener('input', () => el.setCustomValidity(''));
        });
});
