import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', // ✅ point to SCSS
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        sourcemap: true, // Enable source maps
    },
});

