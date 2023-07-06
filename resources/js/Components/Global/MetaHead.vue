<script setup>
import { ref } from 'vue'
import { Head, router, usePage } from '@inertiajs/vue3'

const meta = ref(usePage().props.meta)
const key = ref(new Date().toDateString())

router.on('success', (event) => {
  meta.value = usePage().props.meta
  key.value = event.timeStamp + event.detail.page.component
})
</script>

<template>
    <div :key="key">
        <Head :title="meta.title" :description="meta.description"/>
    </div>
</template>
