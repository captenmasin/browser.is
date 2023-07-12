<script setup>
const props = defineProps({
    text: String
})
</script>

<template>
    <h2 class="font-heading text-xl px-6 pt-4 dark:pt-8 dark:text-white text-primary pb-3 border-b border-gray-200 dark:border-gray-800">
        <slot />
    </h2>
</template>
