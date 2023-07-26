<script setup>
import {ref} from "vue";
import {usePage} from "@inertiajs/vue3";

import ShareLink from "@/Components/Data/ShareLink.vue";
import TableTitle from "@/Components/Global/TableTitle.vue";
import ResultsInfo from "@/Components/Data/ResultsInfo.vue";
import DisplayData from "@/Components/Data/DisplayData.vue";
import LoadingBlock from "@/Components/Global/LoadingBlock.vue";
import PageContainer from "@/Components/Global/PageContainer.vue";
import {useEnum} from "@/Composables/useEnum";
import AppAccordion from "@/Components/Global/AppAccordion.vue";
import SingleFaq from "@/Components/Global/SingleFaq.vue";

const props = defineProps({
    uuid: String,
    url: String,
    date: String || null,
    content: String || null,
})

const isResultsPage = ref(usePage().props.is_results)
</script>

<template>
    <page-container :is-results-page="isResultsPage" :content="content" content-title="About">
        <results-info :date="date" v-if="uuid"/>
        <div class="bg-white dark:bg-gray-800 dark:text-white border-primary/10 border rounded overflow-hidden">
            <Suspense>
                <share-link type="home" :uuid="uuid"/>
            </Suspense>

            <div id="results" class="space-y-2 dark:space-y-0">
                <div v-for="tool in usePage().props.tools">
                    <Suspense v-if="tool.name !== 'All'">
                        <div>
                            <table-title>{{ tool.name }}</table-title>
                            <DisplayData :type="tool.key" :show-table-header="false" :save-results="uuid === null" :uuid="uuid"
                                         :endpoint="route('api.' + tool.key, {uuid: uuid})"/>
                        </div>
                        <template #fallback>
                            <loading-block :text="'Loading ' + tool.key + ' data...'"/>
                        </template>
                    </Suspense>
                </div>
            </div>
        </div>
        <div class="bg-white p-8 mt-4 dark:bg-gray-800 dark:text-white border-primary/10 border rounded overflow-hidden">
            <h2 class="text-4xl font-heading font-bold">Frequently Asked Questions</h2>
            <div class="flex">
                <div class="flex w-1/2">
                    <div class="flex-col space-y-4 mt-8">
                        <single-faq title="What is an IP address">
                            An IP address is a unique numerical label assigned to each device on a computer network using the Internet Protocol (IP) for communication. It serves to identify and locate devices, enabling data to be routed accurately across the internet.
                        </single-faq>
                        <single-faq title="How is my location detected">
                            Your location is detected from your IP address through a process called geolocation. Geolocation databases maintain records of IP address ranges associated with specific geographic locations. Browser.is can query these databases to find the approximate physical location associated with your IP address.
                        </single-faq>
                    </div>
                </div>
                <div class="flex w-1/2">
                    <div class="flex-col space-y-4 mt-8">
                        <single-faq title="What is a browser engine">
                            A browser engine, or rendering engine, is a crucial part of web browsers that interprets and displays web content by processing HTML, CSS, JavaScript, and other assets to create the webpage. It's responsible for rendering the page on the screen, ensuring proper layout and interactivity. Different browsers use distinct rendering engines.
                        </single-faq>
                        <single-faq title="How is my data stored">
                            All information is securely encrypted before being stored in a safe database, only ever being decrypted when sharing your unique link.
                        </single-faq>
                    </div>
                </div>
            </div>
        </div>
    </page-container>
</template>
