import '../css/app.css'
import '../css/fonts.css'
import 'vue3-toastify/dist/index.css'
import.meta.glob([
    '../images/**',
]);
import {createApp, h} from 'vue'
import mitt from 'mitt';
import {createInertiaApp} from '@inertiajs/vue3'
import Layout from "./Layouts/Layout.vue";

const emitter = mitt();

createInertiaApp({
    title: title => `${title} - ${import.meta.env.VITE_APP_NAME}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true})
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || Layout
        return page
    },
    setup({el, App, props, plugin}) {
        const app = createApp({
            render: () => h(App, props)
        });
        app.use(plugin)
        app.config.globalProperties.route = window.route
        app.provide('emitter', emitter);

        app.mount(el)
    },
}).then(r => '')

import NProgress from 'nprogress'
import { router } from '@inertiajs/vue3'

let timeout = null

router.on('start', () => {
    timeout = setTimeout(() => NProgress.start(), 1)
})

router.on('progress', (event) => {
    if (NProgress.isStarted() && event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9)
    }
})

router.on('finish', (event) => {
    clearTimeout(timeout)
    if (!NProgress.isStarted()) {
        // Do nothing
    } else if (event.detail.visit.completed) {
        NProgress.done()
    } else if (event.detail.visit.interrupted) {
        NProgress.set(0)
    } else if (event.detail.visit.cancelled) {
        NProgress.done()
        NProgress.remove()
    }
})
