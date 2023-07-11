<script setup>
const deviceDataResponse = await fetch(route('api.device'));
const deviceData = await deviceDataResponse.json()
</script>

<template>
    <div>
        {{ deviceData }}
    </div>
</template>
