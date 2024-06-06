<script setup>
import html2pdf from "html2pdf.js";

import {onMounted, ref} from "vue";
import emitter from "@/Composables/useEmitter";
import TextInput from "@/Components/Inputs/TextInput.vue";
import AppModal from "@/Components/Global/AppModal.vue";
import EmailForm from "@/Components/Global/EmailForm.vue";
import {usePage} from "@inertiajs/vue3";

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

const data = ref({url: 'Loading URL...'})
const showShareModal = ref(false)

function exportToPdf() {
    pirsch('Export PDF')
    html2pdf(document.getElementById("results"), {
        margin: 1,
        filename: "browser-is-results.pdf",
    });
}

function openEmailModal() {
    showShareModal.value = true
    emitter.emit('open-modal')
}

onMounted(async () => {
    const response = await fetch(route('api.url', {uuid: props.uuid, type: props.type, _token: usePage().props.csrf_token}));
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
