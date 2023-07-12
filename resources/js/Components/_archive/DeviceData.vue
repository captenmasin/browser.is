<script setup>
import DataTable from "@/Components/Global/DataTable.vue";

const props = defineProps({
    tableClass: String,
    showTableHeader: {
        type: Boolean,
        default: true
    }
})

const deviceDataResponse = await fetch(route('api.device'));
const data = await deviceDataResponse.json()
</script>

<template>
    <div>
        <data-table :class="tableClass" :show-header="showTableHeader" :data="data" />
    </div>
</template>
