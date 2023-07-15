<script setup>
const props = defineProps({
    title: String,
})
</script>

<template>
    <div class="p-8 mx-4 mt-8 md:mt-0 md:mx-0 md:w-4/12 rounded-md max-w-5xl shadow-sm text-black border-primary/10 border bg-white dark:bg-gray-800 dark:text-white mb-8">
        <h1 class="text-4xl mb-4 text-secondary font-heading font-bold dark:text-white" v-if="title">
            {{ title }}
        </h1>
        <div class="prose max-w-none prose-headings:text-secondary dark:prose-headings:text-white dark:text-white">
            <slot />
        </div>
    </div>
</template>
