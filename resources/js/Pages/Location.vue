<script setup>
import DisplayData from "@/Components/Data/DisplayData.vue";
import LoadingBlock from "@/Components/Global/LoadingBlock.vue";
import TableTitle from "@/Components/Global/TableTitle.vue";
</script>

<template>
    <div class="bg-white shadow rounded overflow-hidden">
        <div>
            <table-title>Location</table-title>
            <Suspense>
                <DisplayData :show-table-header="false" table-class="rounded-md" :endpoint="route('api.location')"/>
                <template #fallback>
                    <loading-block text="Loading location data..."/>
                </template>
            </Suspense>
        </div>
    </div>
</template>
