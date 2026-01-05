// vite.config.js - ÚJ FÁJL
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/style.css',
                'resources/css/splash.css',
                'resources/js/script.js',
                'resources/js/login.js',
                'resources/js/register.js',
                'resources/js/forgot_password.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        lib: {
            entry: 'resources/js/register.js',
            name: 'Register',
            fileName: (format) => `register.${format}.js`
        }
    }
});