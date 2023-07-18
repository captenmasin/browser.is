<script setup>
const props = defineProps({
    title: String
})
</script>
<template>
    <article>
        <h2 class="text-2xl font-heading text-secondary" v-html="title"></h2>
        <div class="prose text-black">
            <slot/>
        </div>
    </article>
</template>
