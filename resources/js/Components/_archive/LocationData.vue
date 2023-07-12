<script setup>
import DataTable from "@/Components/Global/DataTable.vue";

const props = defineProps({
    tableClass: String,
    showTableHeader: {
        type: Boolean,
        default: true
    }
})

const locationDataResponse = await fetch(route('api.location'));
const data = await locationDataResponse.json()
</script>

<template>
    <div>
        <data-table :class="tableClass" :show-header="showTableHeader" :data="data" />
    </div>
</template>
