import './bootstrap';
import Alpine from 'alpinejs';

// Your components
import merchantForm from './components/merchantForm.js';
import pageTransition from './components/pageTransition.js';
import purchaseForm from './components/purchaseForm.js';
import itemForm from './components/itemForm.js'; // ✅ new
import collapsibleMenu from './components/collapsibleMenu.js';
import registerPurchaseModalStore from './components/purchaseModalStore.js';
import { enableSequentialInput, focusFirstInput } from './utils/formNavigation.js';

window.Alpine = Alpine;
window.enableSequentialInput = enableSequentialInput;
window.focusFirstInput = focusFirstInput;

Alpine.data('merchantForm', merchantForm);
Alpine.data('pageTransition', pageTransition);
Alpine.data('purchaseForm', purchaseForm);
Alpine.data('itemForm', itemForm);
Alpine.data('collapsibleMenu', collapsibleMenu);

registerPurchaseModalStore(Alpine);

Alpine.start();
