<script setup>
import Popper from "vue3-popper"
import {onMounted, ref} from 'vue'
import {useClipboard} from '@vueuse/core'

const props = defineProps({
    modelValue: String,
    label: String,
    disabled: {type: Boolean, default: false},
    copyable: {type: Boolean, default: false},
    readonly: {type: Boolean, default: false},
    hasAutofocus: {type: Boolean, default: true},
    placeholder: {type: String, default: ''},
    inputType: {type: String, default: 'text'},
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
    copy(value)
}

onMounted(() => {
    id.value = "input" + (Math.random() + 1).toString(36).substring(7);
    if (props.hasAutofocus) {
        input.value.focus()
    }
})
</script>

<template>
    <div class="relative">
        <label :for="id" class="text-left text-sm text-secondary/75 block absolute bottom-full pl-1 mb-1" v-if="label">{{ label }}</label>
        <input :placeholder="placeholder" :type="inputType ? inputType : 'text'" ref="input" :value="modelValue"
               :id="id" @focus="$event.target.select()"
               :disabled="disabled" :readonly="readonly"
               @input="$emit('update:modelValue', $event.target.value)"
               class="border border-secondary/20 pl-4 pr-24 py-3 transition-colors w-full focus:border-transparent focus:ring-none rounded-md text-sm dark:bg-gray-900 dark:text-white"/>
        <div class="absolute top-0 right-0 h-full aspect-square flex flex-col items-center justify-center">
            <Popper :hover="true" placement="top" content="Clear" :arrow="true">
                <button type="button" class="bg-secondary/5 mt-[3px] dark:bg-white/5 dark:hover:bg-white/10 hover:bg-secondary/10 rounded-full text-secondary dark:text-white p-[2px]" @click="clear" v-if="modelValue && clearable">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </Popper>
        </div>

        <div class="absolute top-0 right-0 h-full aspect-square flex flex-col items-center justify-center">
            <button type="button" class="bg-secondary/5 text-xs mr-4 dark:bg-white/5 dark:hover:bg-white/10 hover:bg-secondary/10 rounded-full text-secondary dark:text-white px-4 py-1" @click="copyValue(modelValue)" v-if="copyable">
                <span v-if="copied">Copied!</span>
                <span v-else>Copy</span>
            </button>
        </div>
    </div>
</template>
