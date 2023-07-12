<script setup>
const props = defineProps({
    text: {
        type: String,
        default: 'Loading...'
    }
})
</script>

<template>
    <div class="w-full py-12 text-secondary text-center my-4 text-sm">
        {{ text }}
    </div>
</template>
