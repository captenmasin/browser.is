<script setup>
import TextInput from "@/Components/Inputs/TextInput.vue";

const props = defineProps({
    uuid: String,
    url: String,
})

import DisplayData from "@/Components/Data/DisplayData.vue";
import LoadingBlock from "@/Components/Global/LoadingBlock.vue";
import TableTitle from "@/Components/Global/TableTitle.vue";
import ShareLink from "@/Components/Data/ShareLink.vue";
</script>

<template>
    <div class="bg-white shadow rounded overflow-hidden">
        <Suspense>
            <share-link type="home" :uuid="uuid"/>
        </Suspense>

        <div id="results">
            <div>
                <table-title>Browser</table-title>
                <Suspense>
                    <DisplayData type="browser" :show-table-header="false"
                                 :save-results="uuid === null" :uuid="uuid"
                                 :endpoint="route('api.browser', {uuid: uuid})"/>
                    <template #fallback>
                        <loading-block text="Loading browser data..."/>
                    </template>
                </Suspense>
            </div>

            <div>
                <table-title>Device</table-title>
                <Suspense>
                    <DisplayData type="device" :show-table-header="false"
                                 :save-results="uuid === null"
                                 :endpoint="route('api.device', {uuid: uuid})"/>
                    <template #fallback>
                        <loading-block text="Loading device data..."/>
                    </template>
                </Suspense>
            </div>

            <div>
                <table-title>Location</table-title>
                <Suspense>
                    <DisplayData type="location" :show-table-header="false"
                                 :save-results="uuid === null"
                                 :endpoint="route('api.location', {uuid: uuid})"/>
                    <template #fallback>
                        <loading-block text="Loading location data..."/>
                    </template>
                </Suspense>
            </div>
        </div>
    </div>
</template>
