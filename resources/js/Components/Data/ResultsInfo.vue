<script setup>
import {useDateFormat, useTimeAgo} from "@vueuse/core";

const props = defineProps({
    date: String
})

const formattedDate = useDateFormat(props.date, 'YYYY-MM-DD HH:mm')
const timeAgo = useTimeAgo(Date.parse(props.date))
</script>

<template>
    <div class="text-primary p-4 flex-col justify-center text-center font-semibold rounded-md border-primary/10 border bg-white dark:bg-primary dark:text-white mb-8">
        <div>Results created</div>
        <div class="text-secondary">{{ formattedDate }} ({{ timeAgo }})</div>
    </div>
</template>
