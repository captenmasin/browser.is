<script setup>
const props = defineProps({
    text: String
})
</script>

<template>
    <h2 class="font-heading text-xl font-extrabold px-4 sm:px-6 py-4 dark:py-4 dark:text-white text-primary border-b border-gray-200 dark:border-gray-800">
        <slot />
    </h2>
</template>
