import './bootstrap';

import { enableTableSorting } from './sortPatients';

document.addEventListener('DOMContentLoaded', enableTableSorting);

import { toggleEditMode } from './toggleEditMode';

window.toggleEditMode = toggleEditMode;

import './tests';
import './medicinals';
import './exams';



import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
