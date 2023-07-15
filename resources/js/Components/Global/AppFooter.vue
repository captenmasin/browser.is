<script setup lang="ts">
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const info = computed(() => usePage().props.info)
</script>

<template>
    <footer class="mt-auto pb-4 pt-8 text-primary dark:text-white">
        <div class="container mx-auto text-sm flex items-center space-x-2 px-4">
            <div v-if="info.author.url">
                A project by <a target="_blank" class="text-secondary dark:text-white hover:underline" :href="info.author.url">{{ info.author.name }}</a>
            </div>
            <div v-if="info.author.url">
                &bull;
            </div>
            <a target="_blank" class="text-secondary dark:text-white hover:underline" :href="info.support.url">{{ info.support.text }}</a>
            <div v-if="info.reporting.email">
                &bull;
            </div>
            <div v-if="info.reporting.email">
                <a target="_blank" class="text-primary dark:text-white hover:underline" :href="'mailto:' + info.reporting.email + '?subject=Issue+Report'">Report an issue</a>
            </div>
        </div>
    </footer>
</template>
