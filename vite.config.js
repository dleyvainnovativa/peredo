import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js', 
                'resources/js/navigate.js', 'resources/css/theme.css',
                'resources/js/services.js', 'resources/js/manager.js', 'resources/js/file.js',
                'resources/js/employee.js',
                'resources/js/options.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
