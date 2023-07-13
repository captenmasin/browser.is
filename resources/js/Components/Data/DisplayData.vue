<script setup>
import DataTable from "@/Components/Global/DataTable.vue";
import {usePost} from "@/Composables/usePost";

const props = defineProps({
    tableClass: String,
    endpoint: String,
    type: String,
    uuid: String,
    saveResults: {
        type: Boolean,
        default: true
    },
    showTableHeader: {
        type: Boolean,
        default: true
    }
})

const response = await fetch(props.endpoint);
const data = await response.json().then(async data => {
    if(!props.uuid) {
        if (typeof data.window_dimensions !== 'undefined' && data.window_dimensions.value === '') {
            data.window_dimensions.value = window.innerWidth + 'x' + window.innerHeight
        }
        if (typeof data.time !== 'undefined' && data.time.value === '') {
            data.time.value = new Date().toString()
        }

        if (typeof data.incognito_mode !== 'undefined' && data.incognito_mode.value === '') {
            if ('storage' in navigator && 'estimate' in navigator.storage) {
                const {usage, quota} = await navigator.storage.estimate();
                data.incognito_mode.value = usage === 0;
            }
        }
    }

    if(props.saveResults) {
        await usePost(route('api.store'), {
            type: props.type,
            data: JSON.stringify(data)
        })
    }

    return data;
})
</script>

<template>
    <div>
        <data-table :class="tableClass" :show-header="showTableHeader" :data="data" v-if="Object.keys(data).length"/>
        <div v-else class="text-center px-4 pt-4 pb-12 text-sm">
            No data
        </div>
    </div>
</template>
