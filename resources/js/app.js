import './bootstrap';

import Alpine from 'alpinejs';
import merchantForm from './components/merchantForm.js';
import pageTransition from './components/pageTransition.js';
import purchaseForm from './components/purchaseForm.js';
import collapsibleMenu from './components/collapsibleMenu.js'

import { enableSequentialInput, focusFirstInput } from './utils/formNavigation.js';

window.Alpine = Alpine;

window.enableSequentialInput = enableSequentialInput;
window.focusFirstInput = focusFirstInput;

Alpine.data('merchantForm', merchantForm);
Alpine.data('pageTransition', pageTransition);
Alpine.data('purchaseForm',purchaseForm);
Alpine.data('collapsibleMenu', collapsibleMenu)

Alpine.start();
