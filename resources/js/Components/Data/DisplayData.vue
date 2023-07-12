<script setup>
import DataTable from "@/Components/Global/DataTable.vue";

const props = defineProps({
    tableClass: String,
    endpoint: String,
    showTableHeader: {
        type: Boolean,
        default: true
    }
})

const response = await fetch(props.endpoint);
const data = await response.json().then(async data => {
    if (typeof data.window_dimensions !== 'undefined') {
        data.window_dimensions.value = window.innerWidth + 'x' + window.innerHeight
    }

    if (typeof data.incognito_mode !== 'undefined') {
        if ('storage' in navigator && 'estimate' in navigator.storage) {
            const {usage, quota} = await navigator.storage.estimate();
            data.incognito_mode.value = usage === 0;
        }
    }

    return data;
})
</script>

<template>
    <div>
        <data-table :class="tableClass" :show-header="showTableHeader" :data="data"/>
    </div>
</template>
