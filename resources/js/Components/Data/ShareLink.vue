<script setup>
import html2pdf from "html2pdf.js";

import TextInput from "@/Components/Inputs/TextInput.vue";
import {onMounted, ref} from "vue";

const props = defineProps({
    uuid: {
        type: String || null,
        default: null
    },
    type: {
        type: String || null,
        default: null
    }
})

const data = ref({url: ''})

function exportToPdf(){
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
    <div class="w-full bg-gray-100 dark:bg-gray-800 border-gray-900 dark:border-b px-6 py-4 flex items-center">
        <div class="w-1/2">
            <ul class="flex items-center space-x-2">
                <li>
                    <button @click="exportToPdf" class="bg-secondary text-white rounded px-4 py-1 text-sm">
                        Email
                    </button>
                </li>
                <li>
                    <button @click="exportToPdf" class="bg-secondary text-white rounded px-4 py-1 text-sm">
                        Share
                    </button>
                </li>
                <li>
                    <button @click="exportToPdf" class="bg-secondary text-white rounded px-4 py-1 text-sm">
                        Export as PDF
                    </button>
                </li>
            </ul>
        </div>
        <div class="w-1/2">
            <text-input :has-autofocus="false" :model-value="data.url" :copyable="true" :clearable="false" :readonly="true"/>
        </div>
    </div>
</template>
