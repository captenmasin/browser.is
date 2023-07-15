<script setup>
import html2pdf from "html2pdf.js";

import TextInput from "@/Components/Inputs/TextInput.vue";
import {onMounted, ref} from "vue";
import AppModal from "@/Components/Global/AppModal.vue";
import EmailForm from "@/Components/Global/EmailForm.vue";

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
    window.plausible('Export PDF')
    html2pdf(document.getElementById("results"), {
        margin: 1,
        filename: "results.pdf",
    });
}

onMounted(async () => {
    const response = await fetch(route('api.url', {uuid: props.uuid, type: props.type}));
    data.value = await response.json()
})
</script>

<template>
    <div class="w-full flex-col md:flex-row bg-gray-100 space-y-4 md:space-y-0 dark:bg-gray-800 border-gray-900 dark:border-b px-6 py-4 flex items-center">
        <div class="w-full md:w-1/2">
            <ul class="flex items-center justify-center md:justify-normal space-x-2">
                <li>
                    <button @click="showShareModal = true" class="bg-secondary text-white rounded px-4 py-1 text-sm">
                        Send via Email
                    </button>
                </li>
                <li>
                    <button @click="exportToPdf" class="bg-secondary text-white rounded px-4 py-1 text-sm">
                        Export as PDF
                    </button>
                </li>
            </ul>
        </div>
        <div class="w-full md:w-1/2">
            <text-input :has-autofocus="false" :model-value="data.url" :copyable="true" :clearable="false" :readonly="true"/>
        </div>

        <app-modal :show="showShareModal" @close="showShareModal = false">
            <template #title>
                Share results
            </template>
            <email-form :type="type" :uuid="data.uuid"/>
        </app-modal>

    </div>
</template>
