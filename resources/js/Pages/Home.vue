<script setup>
import LocationData from "@/Components/Data/LocationData.vue";
import BrowserData from "@/Components/Data/BrowserData.vue";
import DeviceData from "@/Components/Data/DeviceData.vue";
</script>

<template>
    <div>
        <Suspense>
            <LocationData/>
            <template #fallback>
                Loading location data...
            </template>
        </Suspense>

        <Suspense>
            <BrowserData/>
            <template #fallback>
                Loading browser data...
            </template>
        </Suspense>

        <Suspense>
            <DeviceData/>
            <template #fallback>
                Loading device data...
            </template>
        </Suspense>
    </div>
</template>
