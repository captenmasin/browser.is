<script setup>
import TextInput from "@/Components/Inputs/TextInput.vue";

const props = defineProps({
    uuid: {
        type: String || null,
        default: null
    },
    type: {
        type: String || null,
        default: null
    }
})

const response = await fetch(route('api.url', {uuid: props.uuid, type: props.type}));
const data = await response.json()
</script>

<template>
    <div class="w-full bg-gray-100 px-6 py-4 flex">
        <div class="w-1/2">
            <ul>
                <li>Just copy link</li>
                <li>Email to someone</li>
                <li>Download PDF/PNG</li>
            </ul>
        </div>
        <div class="w-1/2">
            <text-input :has-autofocus="false" :model-value="data.url" :copyable="true" :clearable="false" :readonly="true"/>
        </div>
    </div>
</template>
