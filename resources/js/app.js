// resources/js/app.js
import './bootstrap';
import Alpine from 'alpinejs';


// Import all components
import stateCode from './components/stateCode.js';
import pageTransition from './components/pageTransition.js';
import purchaseForm from './components/purchaseForm.js';
import saleForm from './components/saleForm.js';
import collapsibleMenu from './components/collapsibleMenu.js';
import searchableDropdown from './components/searchableDropdown.js';
import { enableSequentialInput, focusFirstInput } from './utils/formNavigation.js';

window.Alpine = Alpine;

// 🧰 Attach helpers globally (so Blade can use them)
window.enableSequentialInput = enableSequentialInput;
window.focusFirstInput = focusFirstInput;
window.searchableDropdown = searchableDropdown;

Alpine.data('stateCode', stateCode);
Alpine.data('pageTransition', pageTransition);
Alpine.data('purchaseForm', purchaseForm);
Alpine.data('saleForm', saleForm);
Alpine.data('collapsibleMenu', collapsibleMenu);

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


