<script setup>
import {useDateFormat, useTimeAgo} from "@vueuse/core";

const props = defineProps({
    date: String
})

const formattedDate = useDateFormat(props.date, 'YYYY-MM-DD HH:mm:ss')
const timeAgo = useTimeAgo(Date.parse(props.date))
</script>

<template>
    <div class="text-primary pb-2">
        Created: {{ formattedDate }} ({{ timeAgo }})
    </div>
</template>
