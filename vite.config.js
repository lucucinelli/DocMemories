import { defineConfig } from 'vite'; // provides intellisense and autofill in JS files
import laravel from 'laravel-vite-plugin'; // plugin useful for integrating Vite with Laravel, in particularly with Blade templates

export default defineConfig({
    plugins: [
        laravel({  // gives to Laravel paths to the assets analized by Vite
            input: [
                'resources/css/app.css', 
                'resources/js/app.js', 
                'resources/js/sortPatients-init.js',
                'resources/js/tests.js',
                'resources/js/exams.js',
                'resources/js/history.js',
                'resources/js/medicinals.js',
                'resources/js/medicinals-dynamic-table.js',
                'resources/js/exams-dynamic-table.js',
                'resources/js/tests-dynamic-table.js',
                'resources/js/history.js',
                'resources/js/access.js',
            ],
            refresh: true, // enables automatic page refresh when files change, it only works in dev mode
        }),
    ],
});
