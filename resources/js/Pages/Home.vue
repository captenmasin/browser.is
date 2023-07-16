<script setup>
import {ref} from "vue";
import {usePage} from "@inertiajs/vue3";

import ShareLink from "@/Components/Data/ShareLink.vue";
import TableTitle from "@/Components/Global/TableTitle.vue";
import ResultsInfo from "@/Components/Data/ResultsInfo.vue";
import DisplayData from "@/Components/Data/DisplayData.vue";
import LoadingBlock from "@/Components/Global/LoadingBlock.vue";
import PageContainer from "@/Components/Global/PageContainer.vue";

const props = defineProps({
    uuid: String,
    url: String,
    date: String || null,
    content: String || null,
})

const isResultsPage = ref(usePage().props.is_results)
</script>

<template>
    <page-container :is-results-page="isResultsPage" :content="content" content-title="Information">
        <results-info :date="date" v-if="uuid"/>
        <div class="bg-white dark:bg-gray-800 dark:text-white border-primary/10 border rounded overflow-hidden">
            <Suspense>
                <share-link type="home" :uuid="uuid"/>
            </Suspense>

            <div id="results" class="space-y-2 dark:space-y-0">
                <div v-for="tool in usePage().props.tools">
                    <Suspense v-if="tool.key !== 'home'">
                        <div>
                            <table-title>{{ tool.name }}</table-title>
                            <DisplayData type="browser" :show-table-header="false" :save-results="uuid === null" :uuid="uuid"
                                         :endpoint="route('api.' + tool.key, {uuid: uuid})"/>
                        </div>
                        <template #fallback>
                            <loading-block :text="'Loading '+tool.key+' data...'"/>
                        </template>
                    </Suspense>
                </div>
            </div>
        </div>
    </page-container>
</template>
