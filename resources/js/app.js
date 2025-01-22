// resources/js/app.js

import './bootstrap';
import { initializeUpload } from './upload';
import { initializeFaq } from './faq';
import { initializeFlipcard } from './flipcard';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initializeUpload();
    initializeFaq();
    initializeFlipcard();
});
