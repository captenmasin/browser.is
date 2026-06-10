declare global {
    type RouteFunction = (name: string, params?: Record<string, unknown> | string | null) => string

    type AppMeta = {
        description: string
        title: string
    }

    type AppTool = {
        key: string
        name: string
        url: string
    }

    type AppPageProps = {
        [key: string]: unknown
        csrf_token: string
        currentUrl: string
        enums: Record<string, Record<string | number, unknown>>
        info: Record<string, unknown>
        is_results: boolean
        meta: AppMeta
        tools: AppTool[]
        ziggy: Record<string, unknown>
    }

    interface Window {
        pirsch?: (eventName: string) => void
        route: RouteFunction
        Ziggy?: {
            routes: Record<string, unknown>
        }
    }

    const route: RouteFunction
}

declare module '@inertiajs/core' {
    interface PageProps {
        csrf_token: string
        currentUrl: string
        enums: Record<string, Record<string | number, unknown>>
        info: Record<string, unknown>
        is_results: boolean
        meta: AppMeta
        tools: AppTool[]
        ziggy: Record<string, unknown>
    }
}

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        route: RouteFunction
    }
}

export {}
