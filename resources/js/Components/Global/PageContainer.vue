<script setup>
import BasicContent from "./BasicContent.vue";

defineOptions({
    inheritAttrs: false,
})

const props = defineProps({
    isResultsPage: {
        type: Boolean,
        default: false
    },
    content: String,
    contentTitle: String,
})
</script>

<template>
    <div class="flex flex-col md:flex-row items-start">
        <div class="w-full md:w-8/12 mx-auto px-4">
            <slot />
        </div>
        <basic-content v-if="!isResultsPage && content" :title="contentTitle">
            <div v-html="content" />
        </basic-content>
    </div>
</template>
