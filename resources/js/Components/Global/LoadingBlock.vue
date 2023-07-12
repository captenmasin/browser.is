<script setup>
import LoadingBar from "@/Components/Global/LoadingBar.vue";

const props = defineProps({
    text: {
        type: String,
        default: 'Loading...'
    }
})
</script>

<template>
    <div class="w-full py-12 text-secondary dark:text-white text-center my-4 text-sm">
        {{ text }}
        <loading-bar class="mx-auto mt-4 -mb-2" />
    </div>
</template>
