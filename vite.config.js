import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js', 
                'resources/js/sortPatients-init.js',
                'resources/js/tests.js',
                'resources/js/exams.js',
                'resources/js/medicinals.js',
                'resources/js/medicinals-dynamic-table.js',
                'resources/js/exams-dynamic-table.js',
                'resources/js/tests-dynamic-table.js',
            ],
            refresh: true,
        }),
    ],
});
