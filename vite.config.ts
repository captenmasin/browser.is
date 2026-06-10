import path from 'node:path'
import {defineConfig} from 'vite';
import inertia from '@inertiajs/vite';
import laravel from 'laravel-vite-plugin';
import vuePlugin from "@vitejs/plugin-vue";
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
	resolve: {
		alias: {
			'@': path.resolve('./resources/js'),
			'ziggy-js': path.resolve('./vendor/tightenco/ziggy'),
		}
	},
	plugins: [
		laravel({
			input: ['resources/js/app.ts'],
			refresh: true,
		}),
		vuePlugin({
			template: {
				transformAssetUrls: {
					base: null,
					includeAbsolute: false,
				},
			}
		}),
		inertia({
			ssr: {
				entry: 'resources/js/app.ts',
				host: '127.0.0.1',
			},
		}),
		tailwindcss(),
	]
});
