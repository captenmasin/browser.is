<script setup>
const browserDataResponse = await fetch(route('api.browser'));
const browserData = await browserDataResponse.json().then(async data => {
    if ('storage' in navigator && 'estimate' in navigator.storage) {
        const {usage, quota} = await navigator.storage.estimate();
        data['Incognito mode'] = usage === 0;
        return data;
    }
})
</script>

<template>
    <div>
        {{ browserData }}
    </div>
</template>
