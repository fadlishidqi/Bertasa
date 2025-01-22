import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/scrollhidden.css',
                'resources/css/flipcard.css',
                'resources/css/faq.css',
                'resources/css/home.css',
                'resources/js/app.js',
                'resources/js/upload.js',
                
            ],
            refresh: true,
        }),
    ],
});
