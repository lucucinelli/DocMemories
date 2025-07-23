import './bootstrap';

import { enableTableSorting } from './sortPatients';

document.addEventListener('DOMContentLoaded', enableTableSorting);


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
