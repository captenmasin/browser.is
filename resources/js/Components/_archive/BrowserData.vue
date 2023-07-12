<script setup>
import DataTable from "@/Components/Global/DataTable.vue";

const props = defineProps({
    tableClass: String,
    showTableHeader: {
        type: Boolean,
        default: true
    }
})

const browserDataResponse = await fetch(route('api.browser'));
const data = await browserDataResponse.json().then(async data => {
    data.window_dimensions.value = window.innerWidth + 'x' + window.innerHeight
    data.time.value = new Date().toDateString()

    if ('storage' in navigator && 'estimate' in navigator.storage) {
        const {usage, quota} = await navigator.storage.estimate();
        data.incognito_mode.value = usage === 0;
    }

    return data;
})
</script>

<template>
    <div>
        <data-table :class="tableClass" :show-header="showTableHeader" :data="data" />
    </div>
</template>
