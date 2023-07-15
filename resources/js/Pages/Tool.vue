<script setup>
import {ref} from "vue";

const isResultsPage = ref(usePage().props.is_results)

const props = defineProps({
    uuid: String,
    type: String,
    title: String,
    url: String,
})

import DisplayData from "@/Components/Data/DisplayData.vue";
import LoadingBlock from "@/Components/Global/LoadingBlock.vue";
import TableTitle from "@/Components/Global/TableTitle.vue";
import ShareLink from "@/Components/Data/ShareLink.vue";
import {usePage} from "@inertiajs/vue3";
import BasicContent from "@/Components/Global/BasicContent.vue";
</script>

<template>
    <div class="flex items-start">
        <div class="w-8/12 mx-auto px-4">
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
        </div>
        <basic-content title="cdnjkwecw" v-if="!isResultsPage">
            <p>
                Describe what browser.is does and what it can be used for
            </p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius interdum nibh, ac tempus enim accumsan sed. Curabitur leo mi, gravida et ante quis, blandit accumsan eros. Integer ut ligula pulvinar magna imperdiet sollicitudin. Ut fringilla urna tellus, ac aliquet elit dictum sed. Suspendisse suscipit libero odio, congue porta elit lacinia vel.
            </p>
            <h2>
                Lorem ipsum
            </h2>
            <p>
                Integer interdum eros leo, et maximus nisl ullamcorper ac. Nulla erat ante, bibendum ac vulputate et, facilisis at sem. Donec vitae suscipit tellus. Donec egestas ultrices velit ut consectetur. Nunc at porttitor sapien. Nam lobortis magna sit amet dignissim scelerisque. Quisque et nibh ut tortor euismod aliquam vel ut dui. Pellentesque condimentum sodales semper. Aenean sollicitudin varius leo ac rutrum.
            </p>
            <p>
                Nulla posuere a orci eu ultrices. Phasellus condimentum eu dolor et condimentum. Maecenas tortor massa, maximus non mi eu, ultrices elementum mauris. Suspendisse lacinia tellus lacus, sit amet consequat turpis congue ut. Mauris vel tristique neque. Cras vehicula orci commodo purus convallis, vel aliquam leo mollis. Morbi nisl libero, sodales eu nisl eget, pulvinar pretium est.
            </p>
        </basic-content>
    </div>
</template>
