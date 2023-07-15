<script setup>
import {useDateFormat, useTimeAgo} from "@vueuse/core";

const props = defineProps({
    date: String
})

const formattedDate = useDateFormat(props.date, 'YYYY-MM-DD HH:mm')
const timeAgo = useTimeAgo(Date.parse(props.date))
</script>

<template>
    <div class="text-primary pb-2 px-4 font-semibold justify-end flex">
        Results created <span class="text-secondary ml-4"> {{ formattedDate }} ({{ timeAgo }})</span>
    </div>
</template>
