<script setup>
const props = defineProps({
    text: String
})
</script>

<template>
    <h2 class="font-heading text-xl px-6 py-4 text-primary pb-3 border-b border-gray-200">
        <slot />
    </h2>
</template>
