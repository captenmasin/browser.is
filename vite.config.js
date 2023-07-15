import path from 'path'
import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vuePlugin from "@vitejs/plugin-vue";

export default defineConfig({
	resolve: {
		alias: {
			'@': path.resolve('./resources/js'),
		}
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
	],
	build: {
		sourcemap: true,
		rollupOptions: {
			output: {
				manualChunks(id) {
					if (id.includes('node_modules')) {
						return id
							.toString()
							.split('node_modules/')[1]
							.split('/')[0]
							.toString();
					}
				},
			},
		},
	}
});
