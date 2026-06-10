import routeFn from 'ziggy-js'

let ziggyConfig: Record<string, unknown> | null = null

export function setRouteConfig(config: Record<string, unknown> | null | undefined) {
    ziggyConfig = config ?? null
}

export const route: RouteFunction = (name, params = undefined) => {
    const config = ziggyConfig ?? (typeof window !== 'undefined' ? window.Ziggy : null)

    return routeFn(name, params ?? undefined, false, config as any)
}
