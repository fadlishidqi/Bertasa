// resources/js/app.js

import './bootstrap';
import { initializeUpload } from './upload';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initializeUpload();
});
