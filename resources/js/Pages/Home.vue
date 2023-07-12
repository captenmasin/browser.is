<script setup>
import DisplayData from "@/Components/Data/DisplayData.vue";
import LoadingBlock from "@/Components/Global/LoadingBlock.vue";
import TableTitle from "@/Components/Global/TableTitle.vue";
</script>

<template>
    <div class="bg-white shadow rounded overflow-hidden">
        <div class="w-full bg-gray-100 px-6 py-4">
            Share etc
        </div>

        <div>
            <table-title>Browser</table-title>
            <Suspense>
                <DisplayData :show-table-header="false" table-class="rounded-md" :endpoint="route('api.browser')"/>
                <template #fallback>
                    <loading-block text="Loading browser data..."/>
                </template>
            </Suspense>
        </div>

        <div>
            <table-title>Device</table-title>
            <Suspense>
                <DisplayData :show-table-header="false" table-class="rounded-md" :endpoint="route('api.device')"/>
                <template #fallback>
                    <loading-block text="Loading device data..."/>
                </template>
            </Suspense>
        </div>

        <div>
            <table-title>Location</table-title>
            <Suspense>
                <DisplayData :show-table-header="false" :endpoint="route('api.location')"/>
                <template #fallback>
                    <loading-block text="Loading location data..."/>
                </template>
            </Suspense>
        </div>
    </div>
</template>
