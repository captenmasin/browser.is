<script setup>
import {ref} from "vue";

const isResultsPage = ref(usePage().props.is_results)

const props = defineProps({
    uuid: String,
    type: String,
    content: String,
    title: String,
    url: String,
})

import DisplayData from "@/Components/Data/DisplayData.vue";
import LoadingBlock from "@/Components/Global/LoadingBlock.vue";
import TableTitle from "@/Components/Global/TableTitle.vue";
import ShareLink from "@/Components/Data/ShareLink.vue";
import {usePage} from "@inertiajs/vue3";
import BasicContent from "@/Components/Global/BasicContent.vue";
import PageContainer from "@/Components/Global/PageContainer.vue";
</script>

<template>
    <page-container :is-results-page="isResultsPage" :content="content">
        <div class="bg-white dark:bg-gray-800 dark:text-white shadow rounded overflow-hidden">
            <Suspense>
                <share-link :type="type" :uuid="uuid"/>
            </Suspense>

            <div id="results">
                <table-title v-if="title">{{ title }}</table-title>
                <Suspense>
                    <DisplayData :show-table-header="false"
                                 :save-results="uuid === null" :uuid="uuid" :type="type"
                                 :endpoint="route('api.' + type, {uuid: uuid})"/>
                    <template #fallback>
                        <loading-block :text="'Loading ' + type + ' data...'"/>
                    </template>
                </Suspense>
            </div>
        </div>
    </page-container>
</template>
