import './bootstrap';
import { initializeImageUpload } from './upload';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initializeImageUpload();
});