export function sameOriginUrl(value: string): string {
    const url = new URL(value, window.location.origin)

    if (url.hostname === window.location.hostname) {
        return `${window.location.origin}${url.pathname}${url.search}${url.hash}`
    }

    return url.toString()
}

export function withQuery(value: string, params: Record<string, string | number | boolean | null | undefined>): string {
    const url = new URL(sameOriginUrl(value), window.location.origin)

    Object.entries(params).forEach(([key, paramValue]) => {
        if (paramValue !== null && typeof paramValue !== 'undefined') {
            url.searchParams.set(key, String(paramValue))
        }
    })

    return sameOriginUrl(url.toString())
}
