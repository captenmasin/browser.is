import path from 'path'
import {defineConfig} from 'vite';
import {run} from 'vite-plugin-run'
import laravel from 'laravel-vite-plugin';
import vuePlugin from "@vitejs/plugin-vue";

export default defineConfig({
    resolve: {
        alias: {
            '@': path.resolve('./resources/js'),
            'tailwind.config.js': path.resolve(__dirname, 'tailwind.config.js'),
        }
    },
    optimizeDeps: {
        include: [
            'tailwind.config.js',
        ]
    },
    plugins: [
        vuePlugin({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            }
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        run([{}]),
    ],
});
