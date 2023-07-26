<script setup>
const props = defineProps({
    title: String
})
</script>
<template>
    <article>
        <h2 class="text-2xl font-bold font-heading text-secondary dark:text-white" v-html="title"></h2>
        <div class="prose text-black text-sm leading-loose pr-8 dark:text-white">
            <slot/>
        </div>
    </article>
</template>
