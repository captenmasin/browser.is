<script setup>
import TextInput from "../Inputs/TextInput.vue";
import {ref} from "vue";
import {usePost} from "@/Composables/usePost";
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    uuid: String,
    type: String,
})

const email = ref('')
const sent = ref(false)
const errors = ref([])

function submitForm() {
    errors.value = null
    sent.value = false
    usePost(route('api.notify'), {
        email: email.value,
        uuid: props.uuid,
        type: props.type,
        _token: usePage().props.csrf_token
    }).then(response => {
        if (typeof response === 'object') {
            errors.value = response
        } else{
            sent.value = true
            pirsch('Sent via email')

            setTimeout(function () {
                sent.value = false
            }, 5000);
        }
    })
}
</script>

<template>
    <form class="w-full" @submit.prevent="submitForm">
        <div class="text-center mt-4 text-secondary mx-auto" v-if="sent">
            Results sent
        </div>

        <div v-if="!sent">
            <div class="text-sm">
                Share these results with anyone via email
            </div>
            <div class="flex items-start w-full space-x-2 mt-4">
                <div class="w-9/12 flex flex-col">
                    <text-input input-id="emailInput" small v-model="email" placeholder="Email address..."/>
                </div>
                <div class="w-3/12">
                    <button type="submit" class="bg-secondary w-full text-white rounded-md px-4 py-2 border border-secondary text-sm">
                        Send
                    </button>
                </div>
            </div>
            <div class="text-xs text-primary/50 px-1 mt-1">
                Send to multiple emails by separating the addresses with a comma (,)
            </div>
            <div class="text-red-500 text-sm mt-2">
                <ul class="space-y-1">
                    <li v-for="(messages, key) in errors" class="space-y-1">
                        <div v-for="message in messages" class="first-letter:uppercase">
                            {{ message }}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</template>
