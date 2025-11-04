import './bootstrap';

import Alpine from 'alpinejs';
import merchantForm from './components/merchantForm.js';

Alpine.data('merchantForm', merchantForm);

window.Alpine = Alpine;

Alpine.start();
