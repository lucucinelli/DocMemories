import './bootstrap';
import './reloadPositionPatient.js';
import { toggleEditMode } from './toggleEditMode';

window.toggleEditMode = toggleEditMode;



import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
