import './bootstrap';
import Alpine from 'alpinejs';

// Your components
import stateCode from './components/stateCode.js';
import pageTransition from './components/pageTransition.js';
import purchaseForm from './components/purchaseForm.js';
import itemForm from './components/itemForm.js'; // ✅ new
import collapsibleMenu from './components/collapsibleMenu.js';
import searchableDropdown from './components/searchableDropdown.js';
import registerPurchaseModalStore from './components/purchaseModalStore.js';
import { enableSequentialInput, focusFirstInput } from './utils/formNavigation.js';

window.Alpine = Alpine;
window.enableSequentialInput = enableSequentialInput;
window.focusFirstInput = focusFirstInput;
window.searchableDropdown = searchableDropdown;

Alpine.data('stateCode', stateCode);
Alpine.data('pageTransition', pageTransition);
Alpine.data('purchaseForm', purchaseForm);
Alpine.data('itemForm', itemForm);
Alpine.data('collapsibleMenu', collapsibleMenu);

// ✅ Register and initialize your persistent store
registerPurchaseModalStore(Alpine);

// ✅ Load saved items as soon as Alpine starts
document.addEventListener('alpine:init', () => {
    const store = Alpine.store('purchaseModal');
    if (store && store.loadFromLocal) {
        store.loadFromLocal();

        // Optional: live-sync between tabs
        window.addEventListener('storage', () => store.loadFromLocal());
    }
});
Alpine.start();
