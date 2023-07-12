<script setup>
import DisplayData from "@/Components/Data/DisplayData.vue";
import LoadingBlock from "@/Components/Global/LoadingBlock.vue";
import TableTitle from "@/Components/Global/TableTitle.vue";
</script>

<template>
    <div class="bg-white shadow rounded overflow-hidden">
        <div>
            <table-title>Device</table-title>
            <Suspense>
                <DisplayData :show-table-header="false" table-class="rounded-md" :endpoint="route('api.device')"/>
                <template #fallback>
                    <loading-block text="Loading device data..."/>
                </template>
            </Suspense>
        </div>
    </div>
</template>
