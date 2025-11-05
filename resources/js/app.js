import './bootstrap';

import Alpine from 'alpinejs';
import merchantForm from './components/merchantForm.js';
import pageTransition from './components/pageTransition.js';

window.Alpine = Alpine;

Alpine.data('merchantForm', merchantForm);
Alpine.data('pageTransition', pageTransition);

Alpine.start();
