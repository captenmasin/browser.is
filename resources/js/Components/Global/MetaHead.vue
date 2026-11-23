<script setup lang="ts">
import { onBeforeUnmount } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

function upsertMeta(attribute: 'name' | 'property', key: string, content: string | null | undefined): void {
    const existing = document.head.querySelector(`meta[${attribute}="${key}"]`)

    if (!content) {
        existing?.remove()

        return
    }

    const element = existing ?? document.createElement('meta')
    element.setAttribute(attribute, key)
    element.setAttribute('content', content)

    if (!existing) {
        document.head.appendChild(element)
    }
}

function upsertCanonical(href: string | null | undefined): void {
    const existing = document.head.querySelector('link[rel="canonical"]')

    if (!href) {
        existing?.remove()

        return
    }

    const element = existing ?? document.createElement('link')
    element.setAttribute('rel', 'canonical')
    element.setAttribute('href', href)

    if (!existing) {
        document.head.appendChild(element)
    }
}

function applyDocumentMeta(): void {
    const page = usePage<AppPageProps>()
    const meta = page.props.meta

    if (!meta) {
        return
    }

    document.title = meta.title
    upsertMeta('name', 'description', meta.description)
    upsertMeta('property', 'og:title', meta.title)
    upsertMeta('property', 'og:description', meta.description)
    upsertMeta('property', 'og:url', page.props.currentUrl)
    upsertMeta('property', 'og:image', meta.image)
    upsertMeta('name', 'twitter:title', meta.title)
    upsertMeta('name', 'twitter:description', meta.description)
    upsertMeta('name', 'twitter:image', meta.image)
    upsertMeta('name', 'robots', meta.robots)
    upsertCanonical(meta.url)
}

let removeListener: (() => void) | undefined

if (typeof document !== 'undefined') {
    removeListener = router.on('success', () => {
        applyDocumentMeta()
    })
}

onBeforeUnmount(() => {
    removeListener?.()
})
</script>

<template>
    <span hidden></span>
</template>
