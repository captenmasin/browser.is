<script setup>
import Popper from "vue3-popper"
import {onMounted, ref} from 'vue'
import {useClipboard} from '@vueuse/core'
import emitter from "@/Composables/useEmitter";

const props = defineProps({
    modelValue: String,
    label: String,
    disabled: {type: Boolean, default: false},
    copyable: {type: Boolean, default: false},
    readonly: {type: Boolean, default: false},
    hasAutofocus: {type: Boolean, default: true},
    appendHttpsOnCopy: {type: Boolean, default: true},
    small: {type: Boolean, default: false},
    placeholder: {type: String, default: ''},
    inputType: {type: String, default: 'text'},
    inputId: {type: String || null, default: null},
    clearable: {type: Boolean, default: true}
})
const emit = defineEmits(['update:modelValue'])

const input = ref(null)
const id = ref('')

function clear() {
    input.value.value = null
    input.value.focus()
    emit('update:modelValue', '')
}

const {text, copy, copied, isSupported} = useClipboard()

function copyValue(value) {
    if(props.appendHttpsOnCopy){
        value = 'https://' + value
    }
    copy(value)
    window.plausible('Copy URL')
}


onMounted(() => {
    id.value = props.inputId ? props.inputId : "input" + (Math.random() + 1).toString(36).substring(7);
    if (props.hasAutofocus) {
        input.value.focus()
    }
})
</script>

<template>
    <div class="relative">
        <!--        <label :for="id" class="text-left text-sm text-secondary/75 block absolute bottom-full pl-1 mb-1" v-if="label">{{ label }}</label>-->
        <label>
            <span class="sr-only">Label for input</span>
            <input :placeholder="placeholder" :type="inputType ? inputType : 'text'" ref="input" :value="modelValue"
                   :id="id" @focus="$event.target.select()"
                   :disabled="disabled" :readonly="readonly"
                   @input="$emit('update:modelValue', $event.target.value)"
                   :class="small ? 'pl-2 py-2 pr-20' : 'pl-4 py-3 pr-20'"
                   class="border border-secondary/20 focus:outline-0 focus:ring-secondary/20 focus:border-secondary transition-colors w-full focus:ring-0 rounded-md text-sm dark:bg-gray-900 dark:text-white"/>
        </label>
        <div class="absolute top-0 right-0 h-full aspect-square flex flex-col items-center justify-center" v-if="modelValue && clearable">
            <Popper :hover="true" placement="top" content="Clear" :arrow="true">
                <button type="button" class="bg-secondary/5 mt-[3px] dark:bg-white/5 dark:hover:bg-white/10 hover:bg-secondary/10 rounded-full text-secondary dark:text-white p-[2px]" @click="clear">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </Popper>
        </div>

        <div class="absolute top-0 right-0 h-full aspect-square flex flex-col items-center justify-center" v-if="copyable">
            <button type="button" class="bg-secondary/5 text-xs mr-4 dark:bg-white/5 dark:hover:bg-white/10 hover:bg-secondary/10 rounded-full text-secondary dark:text-white px-4 py-1" @click="copyValue(modelValue)">
                <span v-if="copied">Copied!</span>
                <span v-else>Copy</span>
            </button>
        </div>
    </div>
</template>
