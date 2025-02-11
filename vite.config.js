import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/pavo/styles.css',
                'resources/css/pavo/fontawesome-all.css',
                'resources/css/pavo/magnific-popup.css',
                'resources/css/pavo/swiper.css',

                // JS
                'resources/js/app.js',
                'resources/js/pavo/scripts.js',
            ],
            refresh: true,
        }),
    ],
});
