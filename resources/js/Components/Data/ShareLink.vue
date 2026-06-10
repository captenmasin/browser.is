<script setup lang="ts">
import {onMounted, ref} from "vue";
import emitter from "@/Composables/useEmitter";
import TextInput from "@/Components/Inputs/TextInput.vue";
import AppModal from "@/Components/Global/AppModal.vue";
import EmailForm from "@/Components/Global/EmailForm.vue";
import {usePage} from "@inertiajs/vue3";
import {withQuery} from "@/Composables/useUrl";
import {route} from "@/Composables/useRoute";

const props = defineProps({
    uuid: {
        type: String || null,
        default: null
    },
    type: {
        type: String || null,
        default: null
    },
})

type ShareData = {
    url: string
    uuid?: string
}

const data = ref<ShareData>({url: 'Loading URL...'})
const showShareModal = ref(false)

function trackEvent(name: string) {
    if (typeof window.pirsch === 'function') {
        window.pirsch(name)
    }
}

function preparePdfClone(clonedDocument: Document) {
    const cloneRoot = clonedDocument.body ?? clonedDocument.documentElement

    if (!cloneRoot) {
        return
    }

    const elements = [
        clonedDocument.documentElement,
        cloneRoot,
        ...Array.from(cloneRoot.querySelectorAll<HTMLElement | SVGElement>("*")),
    ]

    elements.forEach((element) => {
        element.style.setProperty("color", "#111827", "important")
        element.style.setProperty("background-color", "#ffffff", "important")
        element.style.setProperty("background-image", "none", "important")
        element.style.setProperty("border-color", "#e5e7eb", "important")
        element.style.setProperty("border-top-color", "#e5e7eb", "important")
        element.style.setProperty("border-right-color", "#e5e7eb", "important")
        element.style.setProperty("border-bottom-color", "#e5e7eb", "important")
        element.style.setProperty("border-left-color", "#e5e7eb", "important")
        element.style.setProperty("outline-color", "#e5e7eb", "important")
        element.style.setProperty("text-decoration-color", "#111827", "important")
        element.style.setProperty("caret-color", "#111827", "important")
        element.style.setProperty("accent-color", "#4e4feb", "important")
        element.style.setProperty("column-rule-color", "#e5e7eb", "important")
        element.style.setProperty("fill", "#111827", "important")
        element.style.setProperty("stroke", "#111827", "important")
        element.style.setProperty("flood-color", "#111827", "important")
        element.style.setProperty("lighting-color", "#ffffff", "important")
        element.style.setProperty("stop-color", "#111827", "important")
        element.style.setProperty("box-shadow", "none", "important")
        element.style.setProperty("text-shadow", "none", "important")
    })
}

async function exportToPdf() {
    const results = document.getElementById("results")

    if (!results) {
        return
    }

    trackEvent('Export PDF')

    try {
        const {default: html2pdf} = await import("html2pdf.js")
        await html2pdf().set({
            margin: 1,
            filename: "browser-is-results.pdf",
            image: {type: 'jpeg', quality: 0.98},
            html2canvas: {
                scale: 2,
                useCORS: true,
                onclone: preparePdfClone,
            },
            jsPDF: {unit: 'in', format: 'letter', orientation: 'portrait'},
        }).from(results).save()
    } catch (error) {
        console.error("PDF export failed", error)
    }
}

function openEmailModal() {
    showShareModal.value = true
    emitter.emit('open-modal')
}

onMounted(async () => {
    const response = await fetch(withQuery(route('api.url', {uuid: props.uuid, type: props.type}), {
        _token: usePage<AppPageProps>().props.csrf_token,
    }));
    data.value = await response.json()
    data.value.url = data.value.url.replaceAll("https://", "").replaceAll("http://", "")

    emitter.on('open-modal', () => {
        setTimeout(function () {
            let input = document.getElementById('emailInput')
            input.focus()
        }, 500);
    })
})
</script>

<template>
    <div class="w-full flex-col-reverse lg:flex-row bg-gray-100 dark:bg-gray-800 border-gray-900 dark:border-b px-4 sm:px-6 py-4 flex items-center">
        <div class="w-full lg:w-1/2 mt-4 lg:mt-0">
            <ul class="flex items-center justify-center w-full lg:justify-normal space-x-2">
                <li class="w-full lg:w-auto">
                    <button @click="openEmailModal" class="bg-secondary w-full lg:w-auto text-white rounded px-4 py-2 text-sm">
                        Send via Email
                    </button>
                </li>
                <li class="w-full lg:w-auto">
                    <button @click="exportToPdf" class="bg-secondary w-full lg:w-auto text-white rounded px-4 py-2 text-sm">
                        Export as PDF
                    </button>
                </li>
            </ul>
        </div>
        <div class="w-full flex flex-col items-start sm:flex-row sm:items-center justify-end lg:w-1/2">
            <div class="mr-4 font-heading font-bold mb-2 sm:mb-0">Share URL</div>
            <text-input class="w-full sm:w-9/12 lg:w-8/12" :has-autofocus="false" :model-value="data.url" :copyable="true" :clearable="false" :readonly="true"/>
        </div>

        <app-modal :show="showShareModal" @close="showShareModal = false">
            <template #title>
                Share results
            </template>
            <email-form :type="type" :uuid="data.uuid"/>
        </app-modal>

    </div>
</template>
