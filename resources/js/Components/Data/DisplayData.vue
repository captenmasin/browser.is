<script setup lang="ts">
import {usePage} from "@inertiajs/vue3";
import {usePost} from "@/Composables/usePost";
import {withQuery} from "@/Composables/useUrl";
import DataTable from "@/Components/Global/DataTable.vue";
import {ref} from "vue";


const props = defineProps({
    tableClass: String,
    endpoint: String,
    type: String,
    uuid: String,
    saveResults: {
        type: Boolean,
        default: true
    },
    showTableHeader: {
        type: Boolean,
        default: true
    }
})

const realCoords = ref(null)

const response = await fetch(withQuery(props.endpoint, {
    _token: usePage<AppPageProps>().props.csrf_token,
}));

const data = await response.json().then(async data => {
    if (!props.uuid) {
        if (typeof data.window_dimensions !== 'undefined' && data.window_dimensions.value === '') {
            data.window_dimensions.value = window.innerWidth + ' x ' + window.innerHeight + 'px'
        }
        if (typeof data.screen_dimensions !== 'undefined' && data.screen_dimensions.value === '') {
            data.screen_dimensions.value = screen.width + ' x ' + screen.height + 'px'
        }
        if (typeof data.time !== 'undefined' && data.time.value === '') {
            data.time.value = new Date().toString()
        }

    }

    if (props.saveResults) {
        await usePost(route('api.store'), {
            type: props.type,
            data: JSON.stringify(data)
        })
    }

    return data;
})
</script>

<template>
    <div>
        {{ realCoords }}
        <data-table :class="tableClass" :show-header="showTableHeader" :data="data" v-if="Object.keys(data).length"/>
        <div v-else class="text-center px-4 py-12 text-sm">
            No data
        </div>
    </div>
</template>
