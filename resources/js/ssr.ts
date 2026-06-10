import {createInertiaApp} from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import {renderToString} from '@vue/server-renderer'
import mitt from 'mitt'
import {createSSRApp, h} from 'vue'

import Layout from './Layouts/Layout.vue'
import {route, setRouteConfig} from '@/Composables/useRoute'

const appName = import.meta.env.VITE_APP_NAME

type PageModule = {
    default: Record<string, unknown>
}

createServer(page =>
    createInertiaApp({
        page,
        render: renderToString,
        title: title => `${title} - ${appName}`,
        resolve: name => {
            const pages = import.meta.glob<PageModule>('./Pages/**/*.vue', {eager: true})
            const page = pages[`./Pages/${name}.vue`]
            page.default.layout = page.default.layout || Layout
            return page as any
        },
        setup({App, props, plugin}) {
            setRouteConfig((page.props as any).ziggy)

            const app = createSSRApp({
                render: () => h(App, props),
            })

            app.use(plugin)
            app.config.globalProperties.route = route
            app.provide('emitter', mitt())

            return app
        },
    }),
)
