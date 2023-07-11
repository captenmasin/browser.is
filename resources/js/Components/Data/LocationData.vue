<script setup>
const locationDataResponse = await fetch(route('api.location'));
const locationData = await locationDataResponse.json()
</script>

<template>
    <div>
        {{ locationData }}
    </div>
</template>
