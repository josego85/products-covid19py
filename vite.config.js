import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js'
            ],
            refresh: true,
            publicDirectory: 'public',
        }),
    ],
    resolve: {
        alias: {
            '$': 'jquery',
            'jQuery': 'jquery',
            'window.jQuery': 'jquery',
            'lodash': 'lodash',
            '@': '/resources/js',
        },
    },
    build: {
        outDir: 'public/build',
        manifest: true,
        rollupOptions: {
            input: {
                app: './resources/js/app.js',
                utilities: './public/assets/js/Utilities.js',
                onLoadScripts: './public/assets/js/onLoadScripts.js',
                map: './public/assets/js/Map.js'
            }
        }
    }
});