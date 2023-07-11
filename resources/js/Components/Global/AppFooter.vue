<script setup lang="ts">
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const info = computed(() => usePage().props.info)
</script>

<template>
    <footer class="mt-auto py-4 px-4">
        <div class="container mx-auto text-sm flex items-center space-x-4">
            <div v-if="info.author.url">
                A project by <a target="_blank" class="text-primary dark:text-white hover:underline" :href="info.author.url">@{{ info.author.username }}</a>
            </div>
            <div v-if="info.author.url">
                &bull;
            </div>
            <div v-if="info.reporting.email">
                <a target="_blank" class="text-primary dark:text-white hover:underline" :href="'mailto:' + info.reporting.email + '?subject=Issue+Report'">Report an issue</a>
            </div>
        </div>
    </footer>
</template>
