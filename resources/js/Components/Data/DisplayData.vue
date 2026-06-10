<script setup lang="ts">
import {usePage} from "@inertiajs/vue3";
import {usePost} from "@/Composables/usePost";
import {withQuery} from "@/Composables/useUrl";
import DataTable from "@/Components/Global/DataTable.vue";
import {onMounted, ref} from "vue";
import {route} from "@/Composables/useRoute";


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
const isLoading = ref(true)
const data = ref<Record<string, any>>({})

onMounted(async () => {
    const response = await fetch(withQuery(props.endpoint, {
        _token: usePage<AppPageProps>().props.csrf_token,
    }));

    data.value = await response.json().then(async responseData => {
        if (!props.uuid) {
            if (typeof responseData.window_dimensions !== 'undefined' && responseData.window_dimensions.value === '') {
                responseData.window_dimensions.value = window.innerWidth + ' x ' + window.innerHeight + 'px'
            }
            if (typeof responseData.screen_dimensions !== 'undefined' && responseData.screen_dimensions.value === '') {
                responseData.screen_dimensions.value = screen.width + ' x ' + screen.height + 'px'
            }
            if (typeof responseData.time !== 'undefined' && responseData.time.value === '') {
                responseData.time.value = new Date().toString()
            }

        }

        if (props.saveResults) {
            await usePost(route('api.store'), {
                type: props.type,
                data: JSON.stringify(responseData)
            })
        }

        return responseData;
    })

    isLoading.value = false
})
</script>

<template>
    <div>
        {{ realCoords }}
        <div v-if="isLoading" class="text-center px-4 py-12 text-sm">
            Loading...
        </div>
        <data-table :class="tableClass" :show-header="showTableHeader" :data="data" v-else-if="Object.keys(data).length"/>
        <div v-else class="text-center px-4 py-12 text-sm">
            No data
        </div>
    </div>
</template>
